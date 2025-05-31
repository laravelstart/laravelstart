import { Project, StarterKit } from '@/types/resources';

export type DashboardProps = {
    pinnedKits: StarterKit[];
    recentKits: {
        official: StarterKit[];
        community: StarterKit[];
        my: StarterKit[];
    };
    recentProjects: Project[];
};
