<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function creating(Task $task): void
    {

        if(is_null($task->priority))
        {


            $task->priority = Task::where('project_id', $task->project_id)->max('priority') + 1;

            return;

        }
            $lowPriorityTasks = Task::where('project_id', $task->project_id)
            ->where('priority', '>=', $task->priority )->get();

         


            foreach ($lowPriorityTasks as $lowPriorityTask) {
                $lowPriorityTask->priority++;
                $lowPriorityTask->saveQuietly();

            }
        
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updating(Task $task): void
    {
        //

      

        if($task->isClean())
        {

            return;

        }

       



        if(!$task->isClean('project_id'))
        {



            if(is_null($task->priority))
            {
    
    
                $task->priority = Task::where('project_id', $task->project_id)->max('priority') + 1;
    
                return;
    
            }





                $lowPriorityTasks = Task::where('project_id', $task->project_id)
                ->where('priority', '>=', $task->priority )->get();

             

                foreach ($lowPriorityTasks as $lowPriorityTask) {
                    $lowPriorityTask->priority++;
                    $lowPriorityTask->saveQuietly();
    
                }

                $OriginallowPriorityTasks = Task::where('project_id', $task->getOriginal('project_id'))
                ->where('priority', '>', $task->getOriginal('priority') )->get();
        
                
                // if(!$OriginallowPriorityTasks)
                // {
                //     dd(Task::where('project_id', $task->project_id)->max('priority'));

                //     $task->priority = Task::where('project_id', $task->project_id)->max('priority') + 1;
    

                //     return;
                // }
                // dd($OriginallowPriorityTasks);

                foreach ($OriginallowPriorityTasks as $OriginallowPriorityTask) {
                    $OriginallowPriorityTask->priority--;
                    $OriginallowPriorityTask->saveQuietly();
        
                }


        }


       

        // dd($task);

        if(is_null($task->getOriginal('priority')) > $task->priority)
        {
            $priorityRange = [
                $task->priority, $task->getOriginal('priority')
            ];
        }
        else
        {
            $priorityRange = [
                $task->getOriginal('priority'), $task->priority
            ];
        }

        $lowPriorityTasks = Task::where('project_id', $task->project_id)
            ->whereBetween('priority',$priorityRange )->get();


        foreach ($lowPriorityTasks as $lowPriorityTask) {

            if($task->getOriginal('priority') <  $lowPriorityTask->priority)
            {
                $lowPriorityTask->priority--;

            }
            else
            {
                $lowPriorityTask->priority++;
            }
            $lowPriorityTask->saveQuietly();

        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //

        
        $lowPriorityTasks = Task::where('project_id', $task->project_id)
        ->where('priority', '>', $task->priority )->get();


        foreach ($lowPriorityTasks as $lowPriorityTask) {
            $lowPriorityTask->priority--;
            $lowPriorityTask->saveQuietly();

        }
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
