<?php
namespace App\Repositories\Issue;

use App\Models\Issue;
use App\Repositories\BaseRepository;

class IssueRepository extends BaseRepository implements IssueRepositoryInterface {

    public function __construct(Issue $issue)
    {
        parent::__construct($issue);
    }


}


?>