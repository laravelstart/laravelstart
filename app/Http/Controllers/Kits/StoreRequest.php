<?php

declare(strict_types=1);

namespace App\Http\Controllers\Kits;

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
            'title' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'organisation' => [
                'required',
                'string',
                // in: cached orgs
            ],
            'repositoryName' => [
                'required',
                'string',
                'min:1',
                // in: cached org repos
            ],
            'branchName' => [
                'required',
                'string',
                'min:1',
            ],
            'visibility' => [
                'required',
                'in:public,private',
            ],
        ];
    }

    public function getSourceRepositoryData(): GitRepository
    {
        $isOrganisation = $this->get('organisation') !== 'owner';

        return new GitRepository(
            owner: $isOrganisation ? $this->get('organisation') : $this->user()->name,
            name: $this->get('repositoryName'),
            isOrganisation: $isOrganisation,
            branch: $this->get('branchName')
        );
    }
}
