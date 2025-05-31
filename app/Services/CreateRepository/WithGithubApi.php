<?php

declare(strict_types=1);

namespace App\Services\CreateRepository;

use App\Models\User;
use App\Support\GitRepository;
use Github\AuthMethod;
use Github\Client;

class WithGithubApi implements CreateRepositoryContract
{
    public function __construct(
        protected readonly Client $github
    ) {
    }

    public function handle(GitRepository $target): array
    {
        if (null === $target->isOrganisation) {
            throw new \InvalidArgumentException('isOrganisation parameter is required.');
        }

        if (null === $target->public) {
            throw new \InvalidArgumentException('public parameter is required.');
        }

        return $this->github
            ->api('repo')
            ->create(
                $target->name,
                'This is the description of a repo',
                public: $target->public,
                organization: $target->isOrganisation ? $target->owner : null,
            );
    }

    /**
     * [
     * "id" => 941934851
     * "node_id" => "R_kgDOOCTJAw"
     * "name" => "test-repo-79"
     * "full_name" => "webpnk/test-repo-79"
     * "private" => true
     * "owner" => array:19 [
     * "login" => "webpnk"
     * "id" => 93125849
     * "node_id" => "U_kgDOBYz82Q"
     * "avatar_url" => "https://avatars.githubusercontent.com/u/93125849?v=4"
     * "gravatar_id" => ""
     * "url" => "https://api.github.com/users/webpnk"
     * "html_url" => "https://github.com/webpnk"
     * "followers_url" => "https://api.github.com/users/webpnk/followers"
     * "following_url" => "https://api.github.com/users/webpnk/following{/other_user}"
     * "gists_url" => "https://api.github.com/users/webpnk/gists{/gist_id}"
     * "starred_url" => "https://api.github.com/users/webpnk/starred{/owner}{/repo}"
     * "subscriptions_url" => "https://api.github.com/users/webpnk/subscriptions"
     * "organizations_url" => "https://api.github.com/users/webpnk/orgs"
     * "repos_url" => "https://api.github.com/users/webpnk/repos"
     * "events_url" => "https://api.github.com/users/webpnk/events{/privacy}"
     * "received_events_url" => "https://api.github.com/users/webpnk/received_events"
     * "type" => "User"
     * "user_view_type" => "public"
     * "site_admin" => false
     * ]
     * "html_url" => "https://github.com/webpnk/test-repo-79"
     * "description" => "This is the description of a repo"
     * "fork" => false
     * "url" => "https://api.github.com/repos/webpnk/test-repo-79"
     * "forks_url" => "https://api.github.com/repos/webpnk/test-repo-79/forks"
     * "keys_url" => "https://api.github.com/repos/webpnk/test-repo-79/keys{/key_id}"
     * "collaborators_url" => "https://api.github.com/repos/webpnk/test-repo-79/collaborators{/collaborator}"
     * "teams_url" => "https://api.github.com/repos/webpnk/test-repo-79/teams"
     * "hooks_url" => "https://api.github.com/repos/webpnk/test-repo-79/hooks"
     * "issue_events_url" => "https://api.github.com/repos/webpnk/test-repo-79/issues/events{/number}"
     * "events_url" => "https://api.github.com/repos/webpnk/test-repo-79/events"
     * "assignees_url" => "https://api.github.com/repos/webpnk/test-repo-79/assignees{/user}"
     * "branches_url" => "https://api.github.com/repos/webpnk/test-repo-79/branches{/branch}"
     * "tags_url" => "https://api.github.com/repos/webpnk/test-repo-79/tags"
     * "blobs_url" => "https://api.github.com/repos/webpnk/test-repo-79/git/blobs{/sha}"
     * "git_tags_url" => "https://api.github.com/repos/webpnk/test-repo-79/git/tags{/sha}"
     * "git_refs_url" => "https://api.github.com/repos/webpnk/test-repo-79/git/refs{/sha}"
     * "trees_url" => "https://api.github.com/repos/webpnk/test-repo-79/git/trees{/sha}"
     * "statuses_url" => "https://api.github.com/repos/webpnk/test-repo-79/statuses/{sha}"
     * "languages_url" => "https://api.github.com/repos/webpnk/test-repo-79/languages"
     * "stargazers_url" => "https://api.github.com/repos/webpnk/test-repo-79/stargazers"
     * "contributors_url" => "https://api.github.com/repos/webpnk/test-repo-79/contributors"
     * "subscribers_url" => "https://api.github.com/repos/webpnk/test-repo-79/subscribers"
     * "subscription_url" => "https://api.github.com/repos/webpnk/test-repo-79/subscription"
     * "commits_url" => "https://api.github.com/repos/webpnk/test-repo-79/commits{/sha}"
     * "git_commits_url" => "https://api.github.com/repos/webpnk/test-repo-79/git/commits{/sha}"
     * "comments_url" => "https://api.github.com/repos/webpnk/test-repo-79/comments{/number}"
     * "issue_comment_url" => "https://api.github.com/repos/webpnk/test-repo-79/issues/comments{/number}"
     * "contents_url" => "https://api.github.com/repos/webpnk/test-repo-79/contents/{+path}"
     * "compare_url" => "https://api.github.com/repos/webpnk/test-repo-79/compare/{base}...{head}"
     * "merges_url" => "https://api.github.com/repos/webpnk/test-repo-79/merges"
     * "archive_url" => "https://api.github.com/repos/webpnk/test-repo-79/{archive_format}{/ref}"
     * "downloads_url" => "https://api.github.com/repos/webpnk/test-repo-79/downloads"
     * "issues_url" => "https://api.github.com/repos/webpnk/test-repo-79/issues{/number}"
     * "pulls_url" => "https://api.github.com/repos/webpnk/test-repo-79/pulls{/number}"
     * "milestones_url" => "https://api.github.com/repos/webpnk/test-repo-79/milestones{/number}"
     * "notifications_url" => "https://api.github.com/repos/webpnk/test-repo-79/notifications{?since,all,participating}"
     * "labels_url" => "https://api.github.com/repos/webpnk/test-repo-79/labels{/name}"
     * "releases_url" => "https://api.github.com/repos/webpnk/test-repo-79/releases{/id}"
     * "deployments_url" => "https://api.github.com/repos/webpnk/test-repo-79/deployments"
     * "created_at" => "2025-03-03T09:52:22Z"
     * "updated_at" => "2025-03-03T09:52:23Z"
     * "pushed_at" => "2025-03-03T09:52:23Z"
     * "git_url" => "git://github.com/webpnk/test-repo-79.git"
     * "ssh_url" => "git@github.com:webpnk/test-repo-79.git"
     * "clone_url" => "https://github.com/webpnk/test-repo-79.git"
     * "svn_url" => "https://github.com/webpnk/test-repo-79"
     * "homepage" => ""
     * "size" => 0
     * "stargazers_count" => 0
     * "watchers_count" => 0
     * "language" => null
     * "has_issues" => false
     * "has_projects" => true
     * "has_downloads" => false
     * "has_wiki" => false
     * "has_pages" => false
     * "has_discussions" => false
     * "forks_count" => 0
     * "mirror_url" => null
     * "archived" => false
     * "disabled" => false
     * "open_issues_count" => 0
     * "license" => null
     * "allow_forking" => true
     * "is_template" => false
     * "web_commit_signoff_required" => false
     * "topics" => []
     * "visibility" => "private"
     * "forks" => 0
     * "open_issues" => 0
     * "watchers" => 0
     * "default_branch" => "main"
     * "permissions" => array:5 [
     * "admin" => true
     * "maintain" => true
     * "push" => true
     * "triage" => true
     * "pull" => true
     * ]
     * "allow_squash_merge" => true
     * "allow_merge_commit" => true
     * "allow_rebase_merge" => true
     * "allow_auto_merge" => false
     * "delete_branch_on_merge" => false
     * "allow_update_branch" => false
     * "use_squash_pr_title_as_default" => false
     * "squash_merge_commit_message" => "COMMIT_MESSAGES"
     * "squash_merge_commit_title" => "COMMIT_OR_PR_TITLE"
     * "merge_commit_message" => "PR_TITLE"
     * "merge_commit_title" => "MERGE_MESSAGE"
     * "network_count" => 0
     * "subscribers_count" => 0
     * ]
     */
    public function authorize(User $user): void
    {
        $this->github->authenticate($user->token, AuthMethod::ACCESS_TOKEN);
    }
}
