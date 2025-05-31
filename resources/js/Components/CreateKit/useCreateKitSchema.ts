import { useMemo } from 'react';
import { z } from 'zod';

export default function useCreateKitSchema() {
    return useMemo(() => {
        return z.object({
            title: z
                .string()
                .min(5, 'Please type at least 5 symbols!')
                .max(100, 'Maximum 100 symbols'),
            organisation: z
                .string({ message: 'Please select organisation!' })
                .min(1, 'Please select organisation!'),
            repositoryName: z.string().min(1, 'Please select repository!'),
            branchName: z.string().min(1, 'Please select branch!'),
            visibility: z.enum(['private', 'public']),
        });
    }, []);
}

export type CreateKitSchema = z.infer<ReturnType<typeof useCreateKitSchema>>;
