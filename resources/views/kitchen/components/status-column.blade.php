{{-- 
    Reusable Kitchen Status Column Component
    Props / Template Variables:
    - status: metadata (key, name, short_name, icon, color, glow, next_status, action_label, empty_message)
    - colIndex: column index
    - ticketsByStatus: function to get tickets
--}}
<div class="kds-column" 
     :id="'col-' + status.key"
     :style="'--status-color: ' + status.color + '; --status-glow: ' + status.glow + ';'"
     data-status-key="status.key">
    
    <!-- Column Sticky Header -->
    <header class="kds-col-header">
        <div class="kds-col-title-wrap">
            <span class="kds-col-icon" :style="'background: ' + status.glow + '; color: ' + status.color" x-text="status.icon || '🔖'"></span>
            <div class="kds-col-text">
                <h2 class="kds-col-title" x-text="status.name"></h2>
                <span class="kds-col-sub" x-text="'المرحلة ' + (colIndex + 1) + ' من ' + statuses.length"></span>
            </div>
        </div>
        <div class="kds-col-badge" :style="'border-color: ' + status.color + '44;'">
            <span class="kds-col-pulse" :style="'background-color: ' + status.color"></span>
            <span class="kds-col-count" x-text="ticketsByStatus(status.key).length">0</span>
        </div>
    </header>

    <!-- Column Top Accent Gradient Line -->
    <div class="kds-col-line" :style="'background: linear-gradient(90deg, ' + status.color + ' 0%, transparent 100%);'"></div>

    <!-- Tickets Scrollable List -->
    <div class="kds-tickets-list" :id="'tickets-list-' + status.key">
        
        <!-- Tickets Loop -->
        <template x-for="ticket in ticketsByStatus(status.key)" :key="ticket.id">
            <article class="kds-card" 
                     :id="'ticket-' + ticket.id"
                     :class="{
                         'kds-card-moving-out': movingTicketId === ticket.id,
                         'kds-card-just-arrived': arrivedTicketId === ticket.id,
                         'kds-card-urgent': isUrgent(ticket)
                     }">
                
                <!-- Card Top Status Bar -->
                <div class="kds-card-accent-bar" :style="'background: linear-gradient(90deg, ' + status.color + ', ' + status.color + 'aa);'"></div>
                
                <div class="kds-card-inner">
                    <!-- Ticket Header Row -->
                    <div class="kds-card-header">
                        <div class="kds-card-id-block">
                            <span class="kds-order-num" x-text="'#' + (ticket.order?.order_number || ticket.id)"></span>
                            <div class="kds-order-badges">
                                <span class="kds-badge kds-badge-type" 
                                      :class="'kds-type-' + (ticket.order?.order_type || 'dine_in')" 
                                      x-text="fmtType(ticket.order?.order_type)"></span>
                                <span x-show="ticket.order?.table_number" 
                                      class="kds-badge kds-badge-table"
                                      :title="ticket.order?.table_number"
                                      x-text="cleanTableInfo(ticket.order?.table_number)"></span>
                            </div>
                        </div>

                        <!-- Elapsed Prep Timer -->
                        <div class="kds-timer-pill" 
                             :class="{ 'is-urgent': isUrgent(ticket) }"
                             :title="'الوقت المنقضي منذ إنشاء الطلب'">
                            <span class="kds-timer-icon">⏱</span>
                            <span class="kds-timer-val" x-text="calcTimeAgo(ticket.dispatched_at || ticket.created_at)">الآن</span>
                        </div>
                    </div>

                    <!-- Customer Info & Notes -->
                    <div x-show="ticket.order?.customer_name || ticket.order?.notes" class="kds-card-customer">
                        <div x-show="ticket.order?.customer_name" class="kds-customer-name">
                            <span class="cust-icon">👤</span>
                            <span x-text="ticket.order?.customer_name"></span>
                            <span x-show="ticket.order?.customer_phone" class="cust-phone" x-text="'(' + ticket.order?.customer_phone + ')'"></span>
                        </div>
                        <p x-show="ticket.order?.notes" class="kds-order-note">
                            <span class="note-icon">📝</span>
                            <span x-text="ticket.order?.notes"></span>
                        </p>
                    </div>

                    <!-- Order Items Box (Always clearly visible and formatted) -->
                    <div class="kds-card-items-wrap">
                        <div class="kds-items-header">
                            <span class="kds-items-label">الأصناف المطلوبة</span>
                            <span class="kds-items-total-qty" x-text="totalItemsCount(ticket) + ' صنف'"></span>
                        </div>
                        <ul class="kds-items-list">
                            <template x-for="item in (ticket.order?.items || [])" :key="item.id">
                                <li class="kds-item-row">
                                    <div class="kds-item-info">
                                        <span class="kds-item-qty" x-text="item.quantity + 'x'"></span>
                                        <span class="kds-item-name" x-text="item.product?.name || 'صنف'"></span>
                                    </div>
                                    <span x-show="item.special_instructions" 
                                          class="kds-item-inst" 
                                          :title="item.special_instructions"
                                          x-text="item.special_instructions"></span>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <!-- Ticket Action Row -->
                    <div class="kds-card-footer">
                        <!-- Primary Forward Action Button -->
                        <template x-if="status.next_status">
                            <button type="button"
                                    class="kds-btn-action"
                                    :disabled="isProcessing(ticket.id)"
                                    @click="advanceStatus(ticket, status.next_status)">
                                <span class="kds-btn-text" x-text="status.action_label || ('نقل إلى: ' + getStatusName(status.next_status))"></span>
                                <span class="kds-btn-arrow">←</span>
                            </button>
                        </template>

                        <!-- Final Stage Completion Button -->
                        <template x-if="!status.next_status">
                            <button type="button"
                                    class="kds-btn-action kds-btn-complete"
                                    :disabled="isProcessing(ticket.id)"
                                    @click="completeTicket(ticket)">
                                <span class="kds-btn-text" x-text="status.action_label || '✓ إكمال الطلب وأرشفته'"></span>
                            </button>
                        </template>

                        <!-- Quick Move To Other Stages Dropdown Toggle -->
                        <div class="kds-dropdown-wrap" x-data="{ open: false }">
                            <button type="button" 
                                    @click="open = !open" 
                                    @click.away="open = false"
                                    class="kds-btn-more" 
                                    title="تغيير الحالة يدويًا">
                                <span>•••</span>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="kds-dropdown-enter"
                                 class="kds-dropdown-menu">
                                <div class="kds-dropdown-title">نقل التذكرة مباشرة إلى:</div>
                                <template x-for="targetSt in statuses" :key="targetSt.key">
                                    <button type="button"
                                            x-show="targetSt.key !== status.key"
                                            @click="open = false; advanceStatus(ticket, targetSt.key)"
                                            class="kds-dropdown-item">
                                        <span x-text="targetSt.icon"></span>
                                        <span x-text="targetSt.name"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                </div>
            </article>
        </template>

        <!-- Empty State -->
        <div x-show="ticketsByStatus(status.key).length === 0" class="kds-col-empty">
            <div class="kds-empty-content">
                <div class="kds-empty-icon" x-text="status.icon || '☕'"></div>
                <div class="kds-empty-title" x-text="status.empty_message || 'لا توجد طلبات في هذه المرحلة'"></div>
                <div class="kds-empty-sub">الطلبات ستظهر هنا بمجرد وصولها للمطبخ</div>
            </div>
        </div>

    </div>
</div>
