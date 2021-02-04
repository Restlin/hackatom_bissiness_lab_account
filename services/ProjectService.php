<?php

namespace app\services;

use app\models\Project;
use app\models\Status;
use app\models\ProjectPart;
use app\models\ProjectAccess;
use app\models\Role;
use app\models\User;
use app\models\Part;

/**
 * Сервис по работе с проектами
 *
 * @author restlin
 */
class ProjectService {

    public static function createAuthorAccess(Project $project, User $author): ProjectAccess {
        $access = new ProjectAccess();
        $access->project_id = $project->id;
        $access->role_id = Role::INICIATOR;
        $access->user_id = $author->id;
        $access->save();
        return $access;
    }

    public static function createDefaultParts(Project $project) {
        $parts = Part::find()->orderBy('id')->all();
        foreach($parts as $part) {
            $currentPart = new ProjectPart();
            $currentPart->project_id = $project->id;
            $currentPart->part_id = $part->id;
            $currentPart->ready = false;
            $currentPart->save();
        }
    }

    public static function recalcProject(Project $project) {
        $current = 0;
        $total = 0;
        $maxLevel = 0;
        foreach($project->projectParts as $part) {
            $total += $part->part->weight;
            if($part->ready) {
                $maxLevel = max($maxLevel, $part->part->level);
                $current += $part->part->weight;
            }
        }
        $project->rating = round($current / $total * 100);
        if($maxLevel == 0) {
            $project->status_id = Status::DRAFT;
        } elseif($maxLevel == 1) {
            $project->status_id = Status::IDEA;
        } elseif($maxLevel == 2) {
            $project->status_id = Status::CONCEPTION;
        } elseif($maxLevel == 3 && $project->invested == null) {
            $project->status_id = Status::BUSINESS_PROJECT;
        } elseif($project->invested != null) {
            $project->status_id = Status::RELEASE;
        }
        $project->save(true, ['rating', 'status_id']);
    }
}
