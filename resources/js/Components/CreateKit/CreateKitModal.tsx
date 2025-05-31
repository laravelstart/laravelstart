import BranchSelect from '@/Components/BranchSelect';
import useCreateKitSchema, {
    CreateKitSchema,
} from '@/Components/CreateKit/useCreateKitSchema';
import OrganisationSelect from '@/Components/OrganisationSelect';
import RepositorySelect from '@/Components/RepositorySelect';
import useRefreshRepositories from '@/hooks/useRefreshRepositories';
import useRepositoryBranches from '@/hooks/useRepositoryBranches';
import { DashboardProps } from '@/Pages/Dashboard/_types';
import { PageProps } from '@/types';
import motionProps from '@/utils/motionProps';
import {
    Alert,
    Button,
    Divider,
    Input,
    Modal,
    ModalBody,
    ModalContent,
    ModalFooter,
    ModalHeader,
    Radio,
    RadioGroup,
} from '@heroui/react';
import { zodResolver } from '@hookform/resolvers/zod';
import { router, usePage } from '@inertiajs/react';
import { useCallback, useEffect, useMemo } from 'react';
import { Controller, FormProvider, useForm } from 'react-hook-form';
import { FaDownload, FaInfo } from 'react-icons/fa';

export default function CreateKitModal({
    isOpen,
    onClose,
}: {
    isOpen: boolean;
    onClose: () => void;
}) {
    const { repositories } = usePage<PageProps<DashboardProps>>().props;

    const schema = useCreateKitSchema();

    const form = useForm({
        defaultValues: {
            organisation: 'owner',
            repositoryName: '',
            visibility: 'private' as const,
            branchName: '',
        },
        resolver: zodResolver(schema),
    });

    const selectedRepositoryName = form.watch('repositoryName');
    const selectedRepository = useMemo(() => {
        return repositories?.find((r) => r.name === selectedRepositoryName);
    }, [repositories, selectedRepositoryName]);

    useEffect(() => {
        if (selectedRepository?.private === true) {
            form.setValue('visibility', 'private');
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [selectedRepository]);

    const submit = useCallback(
        (data: CreateKitSchema) => {
            router.post(`/kits`, data, {
                showProgress: true,
                async: true,
                onSuccess: () => onClose(),
            });
        },
        [onClose],
    );

    const selectedOrganisation = form.watch('organisation');

    useEffect(() => {
        form.resetField('repositoryName');
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [selectedOrganisation]);

    useEffect(() => {
        form.resetField('branchName');
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [selectedRepositoryName]);

    useRefreshRepositories({
        enabled: isOpen,
        organisation:
            selectedOrganisation && selectedOrganisation !== 'owner'
                ? selectedOrganisation
                : null,
    });

    useRepositoryBranches({
        enabled: isOpen && !!selectedRepositoryName,
        organisation:
            selectedOrganisation && selectedOrganisation !== 'owner'
                ? selectedOrganisation
                : null,
        repositoryName: selectedRepositoryName,
    });

    const closeModal = useCallback(() => {
        form.reset();
        onClose();
    }, [form, onClose]);

    return (
        <Modal
            isOpen={isOpen}
            onClose={closeModal}
            backdrop="blur"
            motionProps={motionProps}
            classNames={{ backdrop: 'backdrop-blur-sm' }}
            size="2xl"
        >
            <FormProvider {...form}>
                <ModalContent as="form" onSubmit={form.handleSubmit(submit)}>
                    {() => (
                        <>
                            <ModalHeader className="flex flex-col gap-y-4">
                                <h2>Create custom kit</h2>

                                <Input
                                    size="lg"
                                    placeholder="Please make up a name for your kit"
                                    isInvalid={!!form.formState.errors.title}
                                    errorMessage={
                                        form.formState.errors.title?.message
                                    }
                                    autoFocus
                                    {...form.control.register('title')}
                                />
                            </ModalHeader>
                            <Divider />
                            <ModalBody className="gap-y-4">
                                <Alert
                                    className="my-2 text-sm"
                                    icon={<FaInfo />}
                                >
                                    This action will create a reusable starter
                                    kit from your Github repository
                                </Alert>
                                <div className="flex w-full items-center gap-4">
                                    <OrganisationSelect />
                                    <span className="translate-y-[12px] text-xl text-default-400">
                                        {'/'}
                                    </span>
                                    <RepositorySelect
                                        disabled={!selectedOrganisation}
                                    />
                                    <span className="translate-y-[12px] text-xl text-default-400">
                                        {'/'}
                                    </span>
                                    <BranchSelect
                                        disabled={!selectedRepositoryName}
                                    />
                                </div>
                                <div className="flex flex-col gap-y-2">
                                    <Controller
                                        control={form.control}
                                        name="visibility"
                                        render={({
                                            field: { onChange, onBlur, value },
                                        }) => (
                                            <RadioGroup
                                                color="warning"
                                                label="Kit visibility"
                                                isDisabled={
                                                    selectedRepository?.private ===
                                                    true
                                                }
                                                classNames={{
                                                    label: 'text-default-600 text-sm',
                                                }}
                                                {...form.control.register(
                                                    'visibility',
                                                )}
                                                onChange={onChange}
                                                onBlur={onBlur}
                                                value={value}
                                            >
                                                <Radio value="private">
                                                    Private
                                                </Radio>
                                                <Radio
                                                    description={
                                                        selectedRepository?.private ===
                                                        true
                                                            ? 'This kit can not be public as selected repository is private'
                                                            : null
                                                    }
                                                    value="public"
                                                >
                                                    Public
                                                </Radio>
                                            </RadioGroup>
                                        )}
                                    />
                                </div>
                            </ModalBody>
                            <ModalFooter>
                                <Button
                                    color="primary"
                                    variant="bordered"
                                    type="submit"
                                    size="lg"
                                    startContent={<FaDownload />}
                                >
                                    Pull & Create
                                </Button>
                            </ModalFooter>
                        </>
                    )}
                </ModalContent>
            </FormProvider>
        </Modal>
    );
}
