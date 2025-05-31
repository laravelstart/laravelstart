import { Snippet } from '@heroui/react';
import { FaDiscord, FaGithub, FaTwitter } from 'react-icons/fa';
import logo from '../../images/logo_icon.webp';

const Footer = () => {
    return (
        <footer className="border-t border-default-100 bg-default-50 text-default-600">
            <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6">
                <div className="grid grid-cols-1 gap-8 md:grid-cols-4">
                    {/* Brand Section */}
                    <div className="space-y-4 md:col-span-2">
                        <div className="mb-4 flex items-center gap-2 md:mb-0">
                            <img
                                src={logo}
                                alt="Laravel Start"
                                className="h-8 w-8"
                            />
                            <span className="text-xl font-bold text-gray-900">
                                Laravel Start
                            </span>
                        </div>
                        <p className="text-sm text-gray-600">
                            Kick off your next Laravel project with no hassle
                        </p>
                        <div className="flex space-x-4">
                            <a
                                href="https://x.com/webpnkdotdev"
                                className="text-gray-500 transition hover:text-gray-900"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <FaTwitter size={24} />
                            </a>
                            <a
                                href="https://github.com/laravelstart/laravelstart"
                                className="text-gray-500 transition hover:text-gray-900"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <FaGithub size={24} />
                            </a>
                            <a
                                href="https://discord.gg/XdUbDdkU"
                                className="text-gray-500 transition hover:text-gray-900"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <FaDiscord size={24} />
                            </a>
                        </div>
                    </div>

                    {/* Contact Section */}
                    <div>
                        <h3 className="mb-4 font-semibold text-default-600">
                            Contact
                        </h3>
                        <ul className="space-y-4">
                            <li>
                                <label className="block text-sm text-default-600">
                                    Help & Support
                                </label>
                                <Snippet
                                    size="sm"
                                    hideSymbol
                                    variant="bordered"
                                    classNames={{
                                        base: 'border-none px-0',
                                        pre: 'text-default-800 font-sans text-medium',
                                    }}
                                >
                                    webpnk.dev@gmail.com
                                </Snippet>
                            </li>
                            <li>
                                <label className="block text-sm text-default-600">
                                    Business Inquiries
                                </label>
                                <Snippet
                                    size="sm"
                                    hideSymbol
                                    variant="bordered"
                                    classNames={{
                                        base: 'border-none px-0',
                                        pre: 'text-default-800 font-sans text-medium',
                                    }}
                                >
                                    webpnk.dev@gmail.com
                                </Snippet>
                            </li>
                        </ul>
                    </div>

                    {/* Legal Section */}
                    <div>
                        <h3 className="mb-4 font-semibold text-default-600">
                            Legal
                        </h3>
                        <ul className="space-y-2">
                            <li>
                                <a
                                    href="/privacy-policy"
                                    target="_blank"
                                    className="text-default-600 transition hover:text-default-600/80"
                                >
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a
                                    href="/terms"
                                    target="_blank"
                                    className="text-default-600 transition hover:text-default-600/80"
                                >
                                    Terms & Conditions
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div className="mt-12 border-t border-gray-200 pt-8">
                    <div className="flex flex-col items-center justify-between sm:flex-row">
                        <p className="text-sm text-gray-500">
                            {new Date().getFullYear()} © developed by{' '}
                            <a
                                className="font-bold text-default-800 hover:text-default-800/80"
                                href="https://webpnk.dev"
                            >
                                webpnk.dev
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
