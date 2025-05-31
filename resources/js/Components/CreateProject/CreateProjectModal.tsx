import useCreateProjectSchema, {
    CreateProjectSchema,
} from '@/Components/CreateProject/useCreateProjectSchema';
import OrganisationsInput from '@/Components/OrganisationSelect';
import useRefreshRepositories from '@/hooks/useRefreshRepositories';
import { PageProps } from '@/types';
import { StarterKit } from '@/types/resources';
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
import { useCallback, useEffect, useState } from 'react';
import { Controller, FormProvider, useForm } from 'react-hook-form';
import { BiGitBranch, BiGitCommit } from 'react-icons/bi';
import { FaInfo } from 'react-icons/fa';

export default function CreateProjectModal({
    kit,
    onClose,
}: {
    kit?: StarterKit;
    onClose: () => void;
}) {
    const { repositories } = usePage<PageProps>().props;

    const [isOrganisation, setIsOrganisation] = useState(false);

    const schema = useCreateProjectSchema({ repositories, isOrganisation });

    const form = useForm({
        defaultValues: {
            organisation: 'owner',
            repositoryName: '',
            visibility: 'private' as const,
            message: '🍾 What a graceful start!',
        },
        resolver: zodResolver(schema),
    });

    const visibility = form.watch('visibility');
    console.log(visibility);

    const closeModal = useCallback(() => {
        form.reset();
        onClose();
    }, [form, onClose]);

    const submit = useCallback(
        (data: CreateProjectSchema) => {
            if (!kit) {
                return;
            }

            router.post(`/kits/${kit.id}/projects`, data, {
                showProgress: true,
                async: true,
                onSuccess: () => closeModal(),
            });
        },
        [kit, closeModal],
    );

    const selectedOrganisation = form.watch('organisation');

    useEffect(() => {
        if (selectedOrganisation && selectedOrganisation !== 'owner') {
            setIsOrganisation(true);
        }
    }, [selectedOrganisation]);

    useRefreshRepositories({
        enabled: !!kit,
        organisation:
            selectedOrganisation && selectedOrganisation !== 'owner'
                ? selectedOrganisation
                : null,
    });

    return (
        <Modal
            isOpen={kit !== undefined}
            onClose={closeModal}
            backdrop="blur"
            motionProps={motionProps}
            classNames={{ backdrop: 'backdrop-blur-sm' }}
        >
            <FormProvider {...form}>
                <ModalContent as="form" onSubmit={form.handleSubmit(submit)}>
                    {() => (
                        <>
                            <ModalHeader className="flex flex-col gap-4">
                                <h2>Create new Project</h2>

                                <div className="flex gap-3">
                                    <div className="flex aspect-square w-12 items-center justify-center rounded-lg bg-danger-50">
                                        <span className="text-xl font-semibold uppercase text-danger">
                                            {kit?.title.at(0)}
                                        </span>
                                    </div>

                                    <div className="flex flex-col">
                                        <p className="text-md">{kit?.title}</p>
                                        <a
                                            className="text-small text-default-500"
                                            href={kit?.repoUrl}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            <BiGitBranch className="mr-1 inline" />
                                            {kit?.repoOrganisation}/
                                            {kit?.repoName}
                                        </a>
                                    </div>
                                </div>
                            </ModalHeader>
                            <Divider />
                            <ModalBody className="gap-y-4">
                                <Alert
                                    className="my-2 text-sm"
                                    icon={<FaInfo />}
                                >
                                    This action will initialize a new repo in
                                    your Github account with <b>{kit?.title}</b>
                                </Alert>
                                <div className="flex w-full items-center gap-4">
                                    <OrganisationsInput />
                                    <span className="translate-y-[12px] text-xl text-default-400">
                                        {'/'}
                                    </span>
                                    <Input
                                        label={
                                            <span className="text-sm !text-default-600">
                                                Repository name
                                            </span>
                                        }
                                        labelPlacement="outside"
                                        placeholder="supa-cool-app"
                                        errorMessage={
                                            form.formState.errors.repositoryName
                                                ?.message
                                        }
                                        isInvalid={
                                            !!form.formState.errors
                                                .repositoryName
                                        }
                                        {...form.control.register(
                                            'repositoryName',
                                        )}
                                    />
                                </div>

                                <div className="flex flex-col gap-y-2">
                                    <Controller
                                        control={form.control}
                                        name="visibility"
                                        render={({
                                            field: { onChange, onBlur, value },
                                            formState: { defaultValues },
                                        }) => (
                                            <RadioGroup
                                                color="warning"
                                                label="Repository visibility"
                                                classNames={{
                                                    label: 'text-default-600 text-sm',
                                                }}
                                                value={value}
                                                defaultValue={
                                                    defaultValues?.visibility
                                                }
                                                onValueChange={(newValue) =>
                                                    onChange({
                                                        target: {
                                                            value: newValue,
                                                        },
                                                    })
                                                }
                                                onBlur={onBlur}
                                            >
                                                <Radio value="private">
                                                    Private
                                                </Radio>
                                                <Radio value="public">
                                                    Public
                                                </Radio>
                                            </RadioGroup>
                                        )}
                                    />
                                </div>
                            </ModalBody>
                            <ModalFooter className="items-stretch">
                                <Input
                                    label="Init commit message"
                                    isInvalid={!!form.formState.errors.message}
                                    errorMessage={
                                        form.formState.errors.message?.message
                                    }
                                    {...form.control.register('message')}
                                />

                                <Button
                                    color="primary"
                                    variant="bordered"
                                    type="submit"
                                    size="lg"
                                    className="h-auto shrink-0"
                                    startContent={<BiGitCommit />}
                                >
                                    Commit & Push
                                </Button>
                            </ModalFooter>
                        </>
                    )}
                </ModalContent>
            </FormProvider>
        </Modal>
    );
}
