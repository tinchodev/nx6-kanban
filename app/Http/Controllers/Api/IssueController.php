<?php

namespace GitScrum\Http\Controllers\Api;

use GitScrum\Http\Requests\IssueRequest;
use GitScrum\Http\Resources\IssueResource;
use GitScrum\Models\Issue;

class IssueController extends Controller
{
    private $eagerLoad = ['type', 'status', 'configEffort', 'sprint', 'users'];

    public function index()
    {
        $issues = Issue::with($this->eagerLoad)
            ->orderBy('position', 'ASC')
            ->paginate(env('APP_PAGINATE'));

        return IssueResource::collection($issues);
    }

    public function show(Issue $issue)
    {
        return new IssueResource($issue->load($this->eagerLoad));
    }

    public function store(IssueRequest $request)
    {
        $issue = resolve('IssueService')->create($request);

        return (new IssueResource($issue->load($this->eagerLoad)))
            ->response()
            ->setStatusCode(201);
    }

    public function update(IssueRequest $request, Issue $issue)
    {
        $request->merge(['slug' => $issue->slug]);

        resolve('IssueService')->update($request);

        return new IssueResource($issue->fresh()->load($this->eagerLoad));
    }
}
