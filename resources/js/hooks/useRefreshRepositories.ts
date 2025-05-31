import { router } from '@inertiajs/react';
import { useEffect, useRef } from 'react';

export default function useRefreshRepositories({
    enabled = false,
    organisation = null,
}: {
    enabled?: boolean;
    organisation?: string | null;
}) {
    const currentOrganisation = useRef<string | null>(null);
    const previouslyFetched = useRef<boolean>(false);

    useEffect(() => {
        if (!enabled) return;

        if (
            currentOrganisation.current === organisation &&
            previouslyFetched.current
        ) {
            return;
        }

        console.log('eager loading repos for org: ', organisation);

        router.reload({
            only: ['repositories'],
            data: {
                organisation,
            },
            preserveUrl: true,
            async: true,
        });

        currentOrganisation.current = organisation;
        previouslyFetched.current = true;
    }, [organisation, enabled]);
}
