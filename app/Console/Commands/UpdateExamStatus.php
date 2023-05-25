<?php

namespace App\Console\Commands;

use App\Models\Exam;
use Illuminate\Console\Command;

class UpdateExamStatus extends Command
{
    protected $signature = 'exam:update-status';

    protected $description = 'Update exam status based on the current date and time.';

    public function handle()
    {
        $now = now();
        
        $exams = Exam::where('start_time', '<=', $now)
                     ->where('end_time', '>=', $now)
                     ->get();

        foreach ($exams as $exam) {
            if($exam->evaluations()->wherePivot('approved', true)->count() >= 1){
                $exam->is_active = true;
                $exam->save();
            }
        }

        $exams = Exam::where('end_time', '<', $now)
                     ->get();

        foreach ($exams as $exam) {
            $exam->is_active = false;
            $exam->save();
        }
    }
}
