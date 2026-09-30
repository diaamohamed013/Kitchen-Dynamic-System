<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'status', 'dispatched_at', 'started_at', 'ready_at', 'served_at', 'estimated_prep_minutes'
    ];

    protected $casts = [
        'dispatched_at' => 'datetime',
        'started_at' => 'datetime',
        'ready_at' => 'datetime',
        'served_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Dynamically retrieve workflow statuses configured in the database.
     * Preserves exact existing names, ordering, counters, and business logic.
     */
    public static function getWorkflowStatuses(): array
    {
        // 1. Check if a dedicated database table exists
        if (\Illuminate\Support\Facades\Schema::hasTable('kitchen_statuses')) {
            try {
                $rows = \Illuminate\Support\Facades\DB::table('kitchen_statuses')
                    ->orderBy('display_order', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();
                if ($rows->isNotEmpty()) {
                    $count = $rows->count();
                    return $rows->map(function ($row, $idx) use ($rows, $count) {
                        $nextRow = ($idx + 1 < $count) ? $rows->get($idx + 1) : null;
                        $key = $row->slug ?? $row->key ?? (string)$row->id;
                        $nextKey = $nextRow ? ($nextRow->slug ?? $nextRow->key ?? (string)$nextRow->id) : null;
                        $meta = self::getStatusMetadata($key, $nextKey);
                        if (!empty($row->name)) $meta['name'] = $row->name;
                        if (!empty($row->short_name)) $meta['short_name'] = $row->short_name;
                        if (!empty($row->icon)) $meta['icon'] = $row->icon;
                        if (!empty($row->color)) {
                            $meta['color'] = $row->color;
                            $meta['glow'] = self::hexToRgba($row->color, 0.22);
                        }
                        if (!empty($row->action_label)) $meta['action_label'] = $row->action_label;
                        return $meta;
                    })->all();
                }
            } catch (\Throwable $e) {}
        }

        // 2. Read ENUM values dynamically from MySQL database schema on kitchen_tickets.status
        $enumStatuses = [];
        try {
            $columns = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM kitchen_tickets LIKE 'status'");
            if (!empty($columns)) {
                $type = $columns[0]->Type ?? '';
                if (preg_match("/^enum\((.*)\)$/", $type, $matches)) {
                    foreach (explode(',', $matches[1]) as $val) {
                        $enumStatuses[] = trim($val, "'");
                    }
                }
            }
        } catch (\Throwable $e) {}

        // 3. Fallback to distinct statuses from tickets if enum parsing is unavailable
        if (empty($enumStatuses)) {
            try {
                $enumStatuses = self::select('status')->distinct()->pluck('status')->filter()->values()->all();
            } catch (\Throwable $e) {}
        }

        if (empty($enumStatuses)) {
            $enumStatuses = ['received', 'preparing', 'ready'];
        }

        $count = count($enumStatuses);
        $result = [];
        foreach ($enumStatuses as $idx => $key) {
            $nextKey = ($idx + 1 < $count) ? $enumStatuses[$idx + 1] : null;
            $result[] = self::getStatusMetadata($key, $nextKey);
        }

        return $result;
    }

    /**
     * Build rich metadata for a given status, preserving existing names and business logic.
     */
    public static function getStatusMetadata(string $key, ?string $nextKey = null): array
    {
        $known = [
            'queued' => [
                'name' => 'طلبات قيد الانتظار',
                'short_name' => 'في الانتظار',
                'icon' => '⏳',
                'color' => '#0284C7', // Deep Sky Blue (clean separation, high contrast)
                'action_label' => '📥 تحويل للمطبخ',
                'empty_message' => 'لا توجد طلبات في قائمة الانتظار',
            ],
            'received' => [
                'name' => 'طلبات واردة جديدة',
                'short_name' => 'واردة',
                'icon' => '📥',
                'color' => '#EA580C', // Rich Burnt Orange
                'action_label' => '🔥 بدء التحضير',
                'empty_message' => 'لا توجد طلبات واردة حالياً',
            ],
            'preparing' => [
                'name' => 'جاري التحضير 🔥',
                'short_name' => 'تحضير',
                'icon' => '🔥',
                'color' => '#D97706', // Rich Cinnamon Amber (high contrast with white text)
                'action_label' => '✅ جاهز للتسليم',
                'empty_message' => 'لا توجد طلبات قيد التحضير حالياً',
            ],
            'ready' => [
                'name' => 'جاهز للاستلام ✅',
                'short_name' => 'جاهز',
                'icon' => '✅',
                'color' => '#059669', // Rich Basil Emerald (high contrast with white text)
                'action_label' => '📦 تم التسليم',
                'empty_message' => 'لا توجد طلبات جاهزة حالياً',
            ],
            'served' => [
                'name' => 'تم التسليم 📦',
                'short_name' => 'مُسلَّم',
                'icon' => '🎉',
                'color' => '#475569', // Slate Gray
                'action_label' => '✓ أرشفة الطلب',
                'empty_message' => 'لا توجد طلبات مسلّمة في الوردية',
            ],
        ];

        if (isset($known[$key])) {
            $meta = $known[$key];
            $meta['key'] = $key;
            $meta['next_status'] = $nextKey;
            if ($nextKey) {
                if ($nextKey === 'preparing') $meta['action_label'] = '🔥 بدء التحضير';
                elseif ($nextKey === 'ready') $meta['action_label'] = '✅ جاهز للتسليم';
                elseif ($nextKey === 'served') $meta['action_label'] = '📦 تم التسليم';
                elseif ($nextKey === 'received') $meta['action_label'] = '📥 تحويل للمطبخ';
                else $meta['action_label'] = 'نقل إلى: ' . self::formatStatusName($nextKey);
            }
            $meta['glow'] = self::hexToRgba($meta['color'], 0.25);
            return $meta;
        }

        $color = self::generateSensibleColor($key);
        $name = self::formatStatusName($key);
        $nextLabel = $nextKey ? ('نقل إلى: ' . self::formatStatusName($nextKey)) : '✓ إكمال الطلب';

        return [
            'key' => $key,
            'name' => $name,
            'short_name' => $name,
            'icon' => self::detectIcon($key),
            'color' => $color,
            'glow' => self::hexToRgba($color, 0.25),
            'next_status' => $nextKey,
            'action_label' => $nextLabel,
            'empty_message' => 'لا توجد طلبات في مرحلة ' . $name,
        ];
    }

    /**
     * Generate a sensible color from the restaurant design system based on status key,
     * ensuring consistent color regardless of column position.
     */
    public static function generateSensibleColor(string $key): string
    {
        $palette = [
            '#D97706', // Warm Ochre
            '#EA580C', // Burnt Orange
            '#F59E0B', // Saffron Gold
            '#10B981', // Basil Emerald
            '#D94819', // Terracotta
            '#C2410C', // Rust Red
            '#059669', // Deep Emerald
            '#B45309', // Cinnamon Amber
            '#E11D48', // Deep Warm Crimson
            '#78716C', // Warm Slate
        ];

        $hash = abs(crc32(strtolower(trim($key))));
        return $palette[$hash % count($palette)];
    }

    public static function detectIcon(string $key): string
    {
        $k = strtolower(trim($key));
        if (str_contains($k, 'queue') || str_contains($k, 'wait') || str_contains($k, 'انتظار')) return '⏳';
        if (str_contains($k, 'receiv') || str_contains($k, 'incom') || str_contains($k, 'وارد') || str_contains($k, 'جديد')) return '📥';
        if (str_contains($k, 'prep') || str_contains($k, 'تحضير')) return '🔥';
        if (str_contains($k, 'cook') || str_contains($k, 'طهي') || str_contains($k, 'طبخ')) return '🍳';
        if (str_contains($k, 'grill') || str_contains($k, 'شواء')) return '🥩';
        if (str_contains($k, 'bake') || str_contains($k, 'oven') || str_contains($k, 'فرن') || str_contains($k, 'خبز')) return '🥐';
        if (str_contains($k, 'plate') || str_contains($k, 'صحن') || str_contains($k, 'تقديم')) return '🍽️';
        if (str_contains($k, 'pack') || str_contains($k, 'تغليف')) return '🛍️';
        if (str_contains($k, 'check') || str_contains($k, 'فحص') || str_contains($k, 'جودة')) return '🔎';
        if (str_contains($k, 'ready') || str_contains($k, 'جاهز')) return '✅';
        if (str_contains($k, 'serv') || str_contains($k, 'deliv') || str_contains($k, 'توصيل') || str_contains($k, 'تسليم')) return '📦';
        return '🔖';
    }

    public static function formatStatusName(string $key): string
    {
        $k = strtolower(trim($key));
        $map = [
            'queued' => 'طلبات قيد الانتظار',
            'received' => 'طلبات واردة جديدة',
            'preparing' => 'جاري التحضير 🔥',
            'ready' => 'جاهز للاستلام ✅',
            'served' => 'تم التسليم 📦',
            'cooking' => 'جاري الطهي 🍳',
            'grilling' => 'جاري الشواء 🔥',
            'baking' => 'داخل الفرن 🥐',
            'plating' => 'تجهيز الأطباق 🍽️',
            'packaging' => 'قيد التغليف 🛍️',
            'quality_check' => 'فحص الجودة 🔎',
            'delivered' => 'تم التوصيل 🚗',
            'cancelled' => 'ملغي ❌',
        ];

        if (isset($map[$k])) {
            return $map[$k];
        }

        return ucwords(str_replace(['_', '-'], ' ', $key));
    }

    public static function hexToRgba(string $hex, float $alpha = 1.0): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return "rgba({$r}, {$g}, {$b}, {$alpha})";
    }
}

