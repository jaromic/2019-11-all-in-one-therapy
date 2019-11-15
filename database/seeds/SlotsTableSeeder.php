<?php

use App\Documentation;
use App\Patient;
use App\Permission;
use App\Role;
use App\Slot;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SlotsTableSeeder extends Seeder
{
    const SLOTS_START_HOURS = 10;
    const SLOTS_END_HOURS = 16;
    const SLOT_DURATION_MINUTES = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'admin',
            'anna',
            'barbara',
            'clara',
            'david',
        ];

        foreach ($users as $userName) {
            $user = User::where('name', $userName)->firstOrFail();
            $currentSlotDateTime = Carbon::today()->addHours(self::SLOTS_START_HOURS);
            for ($i = 0; $i < rand(5, 40); ++$i) {
                if($currentSlotDateTime->hour>=self::SLOTS_END_HOURS) {
                    $currentSlotDateTime->addDays(1);
                    $currentSlotDateTime->subHours($currentSlotDateTime->hour);
                    continue;
                } elseif($currentSlotDateTime->dayOfWeekIso == 6) { /* skip weekends, we have Saturday */
                    $currentSlotDateTime->addDays(2);
                } elseif($currentSlotDateTime->dayOfWeekIso == 7) { /* skip weekends, we have Sunday */
                    $currentSlotDateTime->addDays(1);
                } else {
                    $currentSlotDateTime->addMinutes(self::SLOT_DURATION_MINUTES);
                }
                if(rand(1,10)<5) { // 50% chance of skipping this possible slot
                    continue;
                }
                $this->createSlot($user, $currentSlotDateTime);
            }
        }
    }

    /**
     * @param $user
     * @param \Carbon\Carbon $currentSlotDateTime
     */
    private function createSlot($user, \Carbon\Carbon $currentSlotDateTime): void
    {
        $slot = new Slot();
        $slot->user()->associate($user);
        $slot->start = $currentSlotDateTime;
        $slot->end = $currentSlotDateTime->copy()->addMinutes(self::SLOT_DURATION_MINUTES);
        $slot->save();
    }
}
