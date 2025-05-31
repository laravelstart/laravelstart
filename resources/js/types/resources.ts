export type Package = {
    package: string;
    version: string;
};

export type KitTag = Package & {
    label: string;
};

export type PublicUser = {
    id: number;
    name: string;
    image: string;
    createdAt: string;
};

export type StarterKit = {
    id: number;
    title: string;
    slug: string;
    installsCount: number;
    user?: PublicUser | null;
    repoOrganisation: string;
    repoName: string;
    repoBranch: string;
    repoUrl: string;
    isPublic: number;
    composerDependencies: Package[] | null;
    nodeDependencies: Package[] | null;
    tags: KitTag[];
    lastUpdatedAt: string;
};

export type Project = {
    id: number;
    kit: StarterKit;
    repoOwner: string;
    repoName: string;
    repoUrl: string;
    sshUrl: string;
    httpsUrl: string;
    commit: {
        commit_sha: string;
        message: string;
        author: string;
        email: string;
        created_at: {
            date: string;
            timezone_type: number;
            timezone: string;
        };
    };
    createdAt: string;
};
