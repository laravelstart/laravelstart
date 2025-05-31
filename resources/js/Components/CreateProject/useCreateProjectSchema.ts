import { RawRepository } from '@/types';
import { useMemo } from 'react';
import { z } from 'zod';

export default function useCreateProjectSchema({
    repositories,
    isOrganisation,
}: {
    repositories: RawRepository[] | null | undefined;
    isOrganisation: boolean;
}) {
    return useMemo(() => {
        return z.object({
            organisation: z
                .string({ message: 'Please select organisation!' })
                .min(1, 'Please select organisation!'),
            repositoryName: z
                .string()
                .min(1, "C'mon, at least one symbol!")
                .max(100, 'Maximum 100 symbols')
                .regex(
                    /^(?![_\-.])(?!.*[_\-.]{2})[a-zA-Z0-9._-]+(?<![_\-.])$/,
                    {
                        message: "Github wouldn't like symbols you used!",
                    },
                )
                .refine(
                    (value) => {
                        if (!repositories) {
                            return true;
                        }

                        return !repositories.map((r) => r.name).includes(value);
                    },
                    `Repository name must be unique within ${isOrganisation ? 'organisation' : 'account'}!`,
                ),
            visibility: z.enum(['private', 'public']),
            message: z.string().min(1, "C'mon, at least one symbol!"),
        });
    }, [repositories, isOrganisation]);
}

export type CreateProjectSchema = z.infer<
    ReturnType<typeof useCreateProjectSchema>
>;
