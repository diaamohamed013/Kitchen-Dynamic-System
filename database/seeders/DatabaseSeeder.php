<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\KitchenTicket;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Sections & Subcategories
        $fastFood = Section::create([
            'name' => 'وجبات سريعة',
            'slug' => 'fast-food',
            'icon' => '🍔',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $grills = Section::create([
            'name' => 'مشويات شرقية',
            'slug' => 'grills',
            'icon' => '🥩',
            'display_order' => 2,
            'is_active' => true,
        ]);

        $drinks = Section::create([
            'name' => 'مشروبات وحلويات',
            'slug' => 'drinks-desserts',
            'icon' => '🥤',
            'display_order' => 3,
            'is_active' => true,
        ]);

        // Subcategories
        $beefBurgers = Subcategory::create([
            'section_id' => $fastFood->id,
            'name' => 'برجر لحم بلدي',
            'slug' => 'beef-burgers',
            'display_order' => 1,
        ]);

        $chickenBurgers = Subcategory::create([
            'section_id' => $fastFood->id,
            'name' => 'برجر وتشيكن مقرمش',
            'slug' => 'chicken-burgers',
            'display_order' => 2,
        ]);

        $appetizers = Subcategory::create([
            'section_id' => $fastFood->id,
            'name' => 'مقبلات وبطاطس',
            'slug' => 'appetizers',
            'display_order' => 3,
        ]);

        $kebab = Subcategory::create([
            'section_id' => $grills->id,
            'name' => 'كباب وكفتة',
            'slug' => 'kebab-kofta',
            'display_order' => 1,
        ]);

        $coldDrinks = Subcategory::create([
            'section_id' => $drinks->id,
            'name' => 'عصائر ومشروبات باردة',
            'slug' => 'cold-drinks',
            'display_order' => 1,
        ]);

        // Products
        $p1 = Product::create([
            'subcategory_id' => $beefBurgers->id,
            'name' => 'دبل سموكد بيكون برجر',
            'slug' => 'double-smoked-bacon-burger',
            'description' => 'شريحتي لحم بقري أنجوس مشوي على اللهب، صوص الباربيكيو المدخن، جبنة شيدر مضاعفة وبيكون مقرمش.',
            'price' => 185.00,
            'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600&auto=format&fit=crop&q=80',
            'is_available' => true,
            'is_best_seller' => true,
            'orders_count' => 142,
        ]);

        $p2 = Product::create([
            'subcategory_id' => $beefBurgers->id,
            'name' => 'مشروم سويس برجر',
            'slug' => 'mushroom-swiss-burger',
            'description' => 'شريحة لحم صافي مع صوص المشروم الكريمي الغني وجبنة إيمنتال سويسرية ذائبة.',
            'price' => 170.00,
            'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600&auto=format&fit=crop&q=80',
            'is_available' => true,
            'is_best_seller' => true,
            'orders_count' => 98,
        ]);

        $p3 = Product::create([
            'subcategory_id' => $chickenBurgers->id,
            'name' => 'رانش زينجر سوبر كرانشي',
            'slug' => 'ranch-zinger-super-crunchy',
            'description' => 'صدور دجاج حارة مقرمشة، خس أمريكي طازج، صوص الرانش المتبل الخاص مع حلقات هالبينو.',
            'price' => 155.00,
            'image' => 'https://images.unsplash.com/photo-1625813506062-0aeb1d7a094b?w=600&auto=format&fit=crop&q=80',
            'is_available' => true,
            'is_best_seller' => true,
            'orders_count' => 112,
        ]);

        $p4 = Product::create([
            'subcategory_id' => $appetizers->id,
            'name' => 'بطاطس ودجز بالجبنة والبيكون',
            'slug' => 'cheddar-bacon-wedges',
            'description' => 'أصابع بطاطس مقرمشة متبلة مغطاة بصوص الشيدر الساخن وقطع البيكون المقرمش والبصل الأخضر.',
            'price' => 85.00,
            'image' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=600&auto=format&fit=crop&q=80',
            'is_available' => true,
            'is_best_seller' => false,
            'orders_count' => 64,
        ]);

        $p5 = Product::create([
            'subcategory_id' => $kebab->id,
            'name' => 'وجبة ميكس كباب وكفتة مشوية',
            'slug' => 'mix-grill-kebab-kofta',
            'description' => 'نصف كيلو مشويات مشكلة على الفحم تقدم مع أرز بسمتي بالمكسرات، طحينة، وسلطة خضراء.',
            'price' => 310.00,
            'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&auto=format&fit=crop&q=80',
            'is_available' => true,
            'is_best_seller' => true,
            'orders_count' => 88,
        ]);

        $p6 = Product::create([
            'subcategory_id' => $coldDrinks->id,
            'name' => 'موهيتو توت بري وباشن فروت',
            'slug' => 'berry-passion-mojito',
            'description' => 'مشروب منعش محضر من أوراق النعناع الطازج، صوص الباشن فروت والتوت مع ليمون صودا مثلج.',
            'price' => 65.00,
            'image' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=600&auto=format&fit=crop&q=80',
            'is_available' => true,
            'is_best_seller' => false,
            'orders_count' => 45,
        ]);

        // Demo Orders & Kitchen Tickets
        // Order 1: Ready to dispatch in admin
        $order1 = Order::create([
            'order_number' => 'ORD-1001',
            'customer_name' => 'أحمد محمود',
            'customer_phone' => '01012345678',
            'order_type' => 'dine_in',
            'table_number' => 'طاولة 3',
            'total_amount' => 340.00,
            'payment_status' => 'paid',
            'payment_method' => 'card',
            'notes' => 'العميل يفضل تقديم المشروب مع الأكل مباشرة.',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $p1->id,
            'quantity' => 1,
            'unit_price' => 185.00,
            'total_price' => 185.00,
            'special_instructions' => 'بدون طماطم / زيادة صوص',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $p3->id,
            'quantity' => 1,
            'unit_price' => 155.00,
            'total_price' => 155.00,
            'special_instructions' => 'إكسترا سبايسي',
        ]);

        KitchenTicket::create([
            'order_id' => $order1->id,
            'status' => 'queued', // Waiting for admin dispatch
            'estimated_prep_minutes' => 15,
        ]);

        // Order 2: Already dispatched, in "received" stage in kitchen
        $order2 = Order::create([
            'order_number' => 'ORD-1002',
            'customer_name' => 'سارة علي',
            'customer_phone' => '01198765432',
            'order_type' => 'takeaway',
            'total_amount' => 255.00,
            'payment_status' => 'paid',
            'payment_method' => 'card',
            'notes' => 'سفري استلام فوري',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $p2->id,
            'quantity' => 1,
            'unit_price' => 170.00,
            'total_price' => 170.00,
            'special_instructions' => 'مستوي جيداً (Well done)',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $p4->id,
            'quantity' => 1,
            'unit_price' => 85.00,
            'total_price' => 85.00,
            'special_instructions' => 'الصوص منفصل جانباً',
        ]);

        KitchenTicket::create([
            'order_id' => $order2->id,
            'status' => 'received',
            'dispatched_at' => now()->subMinutes(3),
            'estimated_prep_minutes' => 15,
        ]);

        // Order 3: In preparing stage
        $order3 = Order::create([
            'order_number' => 'ORD-1003',
            'customer_name' => 'طارق كمال',
            'customer_phone' => '01234567890',
            'order_type' => 'delivery',
            'total_amount' => 375.00,
            'payment_status' => 'paid',
            'payment_method' => 'online',
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $p5->id,
            'quantity' => 1,
            'unit_price' => 310.00,
            'total_price' => 310.00,
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $p6->id,
            'quantity' => 1,
            'unit_price' => 65.00,
            'total_price' => 65.00,
        ]);

        KitchenTicket::create([
            'order_id' => $order3->id,
            'status' => 'preparing',
            'dispatched_at' => now()->subMinutes(12),
            'started_at' => now()->subMinutes(8),
            'estimated_prep_minutes' => 20,
        ]);
    }
}
