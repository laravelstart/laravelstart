import { Config } from 'ziggy-js';

export type User = {
    id: number;
    name: string;
    email: string;
    emailVerifiedAt?: string;
    image?: string;
    createdAt: string;
    updatedAt: string;
};

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
    TAuthenticated extends boolean | unknown = unknown,
> = T & {
    auth: {
        user: TAuthenticated extends unknown
            ? User | null
            : TAuthenticated extends true
              ? User
              : null;
    };
    ziggy: Config & { location: string };
    organisations: RawOrganisation[];
    repositories?: RawRepository[] | null;
    branches?: string[] | null;
    toast?: string;
};

export type AuthenticatedPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = PageProps<T, true>;

export type RawOrganisation = { login: string; avatar_url?: string };
export type RawRepository = { name: string; private: boolean };
