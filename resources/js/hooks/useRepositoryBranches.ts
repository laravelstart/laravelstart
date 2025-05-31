import { router } from '@inertiajs/react';
import { useEffect } from 'react';

export default function useRepositoryBranches({
    enabled,
    organisation,
    repositoryName,
}: {
    enabled: boolean;
    organisation: string | null;
    repositoryName: string;
}) {
    useEffect(() => {
        if (!enabled || !repositoryName) {
            return;
        }

        console.log(
            'eager loading branches for repo: ',
            organisation,
            repositoryName,
        );

        router.reload({
            only: ['branches'],
            data: {
                organisation,
                repositoryName,
            },
            preserveUrl: true,
            async: true,
        });
    }, [organisation, repositoryName, enabled]);
}
