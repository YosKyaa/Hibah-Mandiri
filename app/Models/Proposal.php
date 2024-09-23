<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'users_id',
        'research_types_id',
        'research_topics_id',
        'research_title',
        'tkt_types_id',
        'main_research_targets_id',
        'document',
        'status_id',
        'notes',
        'review_date_start',
        'review_date_end',
        'reviewer_id',
        'student_team',
        'external_team',
        'total_fund',
        'presentation_date',
        'presentation_time',
        'review_notes',
        'review_notes_2',
        'approval_reviewer',
        'approval_admin_fundfinalization',
        'approval_vice_rector_1',
        'approval_vice_rector_2',
        'bank_id',
        'bank_account_number',
        'bank_account_name',
        'monev_comment'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(isset($filters['search']), function ($query) use ($filters) {
            $search = $filters['search'];
            return $query->where('research_title', 'like', '%' . $search . '%')
                ->orWhereHas('users', function ($query) use ($search) {
                    $query->where('username', 'like', '%' . $search . '%');
                });
        });
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function proposalTeams() {
        return $this->hasMany(ProposalTeams::class,'proposals_id');
    }

    public function documents()
    {
        return $this->hasMany(Documents::class, 'proposals_id');
    }

    public function researcher()
    {
        return $this->belongsTo(User::class, 'researcher_id');
    }
    public function researchType()
    {
        return $this->belongsTo(ResearchTypes::class, 'research_types_id');
    }


    public function researchTopic()
    {
        return $this->belongsTo(ResearchTopics::class, 'research_topics_id');
    }
    public function tktType()
    {
        return $this->belongsTo(TktTypes::class, 'tkt_types_id');
    }

    public function mainResearchTarget()
    {
        return $this->belongsTo(MainResearchTarget::class, 'main_research_targets_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }





}
