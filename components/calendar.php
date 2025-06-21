<?php
// Sample data for calendar events
$events = [
    [
        'date' => date('Y-m-d', strtotime('+2 days')),
        'title' => 'Pemeriksaan Gratis',
        'description' => 'Pemeriksaan kesehatan umum gratis untuk masyarakat'
    ],
    // ... (data event lainnya tetap sama)
];

// Get current month and year
$currentMonth = date('m');
$currentYear = date('Y');
$currentDate = date('Y-m-d');

// Get first day of month and total days
$firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));
$totalDaysInMonth = date('t', strtotime("$currentYear-$currentMonth-01"));
?>

<section class="py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                Kalender Kegiatan
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Jadwal kegiatan dan program kesehatan di Klinik Sehat
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        <?= date('F Y', strtotime("$currentYear-$currentMonth-01")) ?>
                    </h3>
                    <div class="flex space-x-2">
                        <a href="?month=<?= date('m-Y', strtotime("$currentYear-$currentMonth-01 -1 month")) ?>" 
                           class="p-2 rounded-lg hover:bg-gray-100">
                            <i data-lucide="chevron-left" class="h-5 w-5 text-gray-600"></i>
                        </a>
                        <a href="?month=<?= date('m-Y', strtotime("$currentYear-$currentMonth-01 +1 month")) ?>" 
                           class="p-2 rounded-lg hover:bg-gray-100">
                            <i data-lucide="chevron-right" class="h-5 w-5 text-gray-600"></i>
                        </a>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-2 mb-6">
                    <?php 
                    $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    foreach ($days as $day): 
                    ?>
                        <div class="text-center font-medium text-gray-500 py-2">
                            <?= $day ?>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    // Fill empty cells before first day
                    for ($i = 1; $i < $firstDayOfMonth; $i++) {
                        echo '<div class="h-12"></div>';
                    }
                    
                    // Fill calendar days
                    for ($day = 1; $day <= $totalDaysInMonth; $day++) {
                        $currentDateFormatted = date('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                        $isToday = ($currentDateFormatted == $currentDate);
                        $hasEvent = false;
                        $eventTitle = '';
                        
                        foreach ($events as $event) {
                            if ($event['date'] == $currentDateFormatted) {
                                $hasEvent = true;
                                $eventTitle = $event['title'];
                                break;
                            }
                        }
                        
                        echo '<div class="h-12 border rounded-lg p-1 relative ' . 
                             ($isToday ? 'border-blue-500 bg-blue-50' : 'border-gray-200') . '">';
                        echo '<div class="text-right text-sm ' . 
                             ($isToday ? 'font-bold text-blue-700' : 'text-gray-700') . '">' . $day . '</div>';
                        
                        if ($hasEvent) {
                            echo '<div class="absolute bottom-0 left-0 right-0 px-1">';
                            echo '<div class="bg-blue-100 text-blue-800 text-xs p-1 rounded truncate">' . 
                                 htmlspecialchars($eventTitle) . '</div>';
                            echo '</div>';
                        }
                        
                        echo '</div>';
                    }
                    
                    // Fill remaining cells if needed (to complete the last row)
                    $totalCells = $firstDayOfMonth + $totalDaysInMonth - 1;
                    $remainingCells = 7 - ($totalCells % 7);
                    if ($remainingCells < 7) {
                        for ($i = 0; $i < $remainingCells; $i++) {
                            echo '<div class="h-12"></div>';
                        }
                    }
                    ?>
                </div>

                <!-- Upcoming Events List -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Kegiatan Mendatang</h4>
                    <div class="space-y-4">
                        <?php 
                        // Sort events by date
                        usort($events, function($a, $b) {
                            return strtotime($a['date']) - strtotime($b['date']);
                        });
                        
                        foreach ($events as $event): 
                            if (strtotime($event['date']) >= strtotime($currentDate)):
                        ?>
                            <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="bg-blue-100 text-blue-800 rounded-lg p-3 text-center min-w-[60px]">
                                    <div class="text-sm font-medium">
                                        <?= date('d', strtotime($event['date'])) ?>
                                    </div>
                                    <div class="text-xs">
                                        <?= date('M', strtotime($event['date'])) ?>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900"><?= htmlspecialchars($event['title']) ?></h5>
                                    <p class="text-sm text-gray-600"><?= htmlspecialchars($event['description']) ?></p>
                                </div>
                            </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
