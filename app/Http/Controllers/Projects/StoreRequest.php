<?php

declare(strict_types=1);

namespace App\Http\Controllers\Projects;

use App\Models\StarterKit;
use App\Support\GitRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        // get orgs from cache
        // get repos from cache

        return [
            'organisation' => [
                'required',
                'string',
                // in: cached orgs
            ],
            'repositoryName' => [
                'required',
                'string',
                'min:1',
                'max:100',
                'regex:/^(?![_\-.])(?!.*[_\-.]{2})[a-zA-Z0-9._-]+(?<![_\-.])$/',
                // in: cached org repos
            ],
            'visibility' => [
                'required',
                'in:public,private',
            ],
            'message' => [
                'required',
                'string',
                'min:1',
            ],
        ];
    }

    public function getSourceRepositoryData(): GitRepository
    {
        /** @var StarterKit $kit */
        $kit = $this->route('kit');

        return new GitRepository(
            owner: $kit->repo_organisation,
            name: $kit->repo_name,
            branch: $kit->repo_branch,
        );
    }

    public function getTargetRepositoryData(): GitRepository
    {
        $isOrganisation = $this->get('organisation') !== 'owner';

        return new GitRepository(
            owner: $isOrganisation ? $this->get('organisation') : $this->user()->name,
            name: $this->get('repositoryName'),
            isOrganisation: $isOrganisation,
            public: $this->get('visibility') === 'public',
        );
    }
}
