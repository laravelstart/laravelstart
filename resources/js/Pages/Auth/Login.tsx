import MobileAlert from '@/Components/MobileAlert';
import { Button, Card, CardBody, CardHeader, Image } from '@heroui/react';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { isMobile } from 'react-device-detect';
import { FaGithub } from 'react-icons/fa';
import logo from '../../../images/logo_full.webp';

export default function Login() {
    return (
        <>
            <Head>
                <title>Sign In</title>
            </Head>
            {isMobile && <MobileAlert className="fixed z-50" />}
            <div className="relative flex min-h-screen items-center justify-center overflow-hidden bg-background max-sm:px-4">
                {/* Animated background elements */}
                <div className="absolute inset-0 overflow-hidden">
                    <motion.div
                        className="absolute -inset-[10px] opacity-50"
                        animate={{
                            background: [
                                'radial-gradient(circle at 20% 20%, #fc051d 0%, transparent 70%)',
                                'radial-gradient(circle at 60% 60%, #fc051d 0%, transparent 70%)',
                                'radial-gradient(circle at 20% 20%, #fc051d 0%, transparent 70%)',
                            ],
                        }}
                        transition={{
                            duration: 8,
                            repeat: Infinity,
                            ease: 'linear',
                        }}
                    />
                    <motion.div
                        className="absolute -inset-[10px] opacity-30"
                        animate={{
                            background: [
                                'radial-gradient(circle at 80% 80%, #7f010e 0%, transparent 70%)',
                                'radial-gradient(circle at 40% 40%, #7f010e 0%, transparent 70%)',
                                'radial-gradient(circle at 80% 80%, #7f010e 0%, transparent 70%)',
                            ],
                        }}
                        transition={{
                            duration: 8,
                            repeat: Infinity,
                            ease: 'linear',
                            delay: 1,
                        }}
                    />
                </div>

                {/* Floating shapes */}
                <motion.div
                    className="absolute left-20 top-20 h-64 w-64 rounded-full bg-gradient-to-br from-red-500/20 to-red-700/20 blur-3xl"
                    animate={{
                        y: [0, 50, 0],
                        x: [0, 30, 0],
                        scale: [1, 1.1, 1],
                    }}
                    transition={{
                        duration: 10,
                        repeat: Infinity,
                        ease: 'linear',
                    }}
                />
                <motion.div
                    className="absolute bottom-20 right-20 h-64 w-64 rounded-full bg-gradient-to-br from-primary-700/20 to-primary-500/20 blur-3xl"
                    animate={{
                        y: [0, -50, 0],
                        x: [0, -30, 0],
                        scale: [1, 1.1, 1],
                    }}
                    transition={{
                        duration: 10,
                        repeat: Infinity,
                        ease: 'linear',
                        delay: 1,
                    }}
                />

                {/* Login Card */}
                <Card className="w-full max-w-md bg-background/50 p-2 shadow-2xl backdrop-blur-xl">
                    <CardHeader className="flex flex-col items-center gap-2">
                        <motion.div
                            initial={{ scale: 0.5, opacity: 0 }}
                            animate={{ scale: 1, opacity: 1 }}
                            transition={{ duration: 0.5 }}
                        >
                            <Image src={logo} className="w-32" />
                        </motion.div>

                        <h1 className="text-3xl font-semibold text-primary-900">
                            Laravel Start
                        </h1>
                    </CardHeader>
                    <CardBody>
                        <p className="mb-6 text-center text-small text-primary-800">
                            Start your journey connecting your Github
                        </p>

                        <Button
                            as="a"
                            href="/auth/github"
                            size="lg"
                            className="w-full bg-gradient-to-r from-primary-500 to-primary-700 text-white shadow-lg"
                            startContent={<FaGithub size={24} />}
                        >
                            Continue with GitHub
                        </Button>
                        <p className="mt-4 text-center text-tiny text-primary-800/70">
                            By continuing, you agree to our{' '}
                            <a
                                href="/terms"
                                target="_blank"
                                className="text-red-500 transition-colors hover:text-red-600"
                            >
                                Terms of Service
                            </a>{' '}
                            and{' '}
                            <a
                                href="/privacy-policy"
                                target="_blank"
                                className="text-red-500 transition-colors hover:text-red-600"
                            >
                                Privacy Policy
                            </a>
                        </p>
                    </CardBody>
                </Card>
            </div>
        </>
    );
}
