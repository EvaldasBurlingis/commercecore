import {Link} from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo.jsx';

export default function Footer() {
    return (
        <footer
            className="bg-footer-background text-footer-foreground text-center py-5 px-6 font-sans lg:flex lg:items-center lg:justify-between lg:py-3 lg:pr-20">
            <div className={'lg:flex lg:items-center'}>
                <div className={'mb-6 flex justify-center lg:ml-32 lg:mr-7 lg:mb-0'}>
                    <ApplicationLogo className={'lg:w-28'}/>
                </div>
                <div className={'flex justify-around text-xs font-light tracking-wide mb-6 lg:mb-0'}>
                    <Link to={'#'} className={'lg:mr-8'}>Terms of Service</Link>
                    <Link to={'#'} className={'lg:mr-8'}>Privacy Policy</Link>
                    <Link to={'#'} className={'lg:mr-8'}>Returns</Link>
                    <Link to={'#'} className={'lg:mr-8'}>FAQ</Link>
                </div>
            </div>
            <div className={'text-xs font-light'}>
                <span>
                    &copy; 2022 MAXHDS. All rights reserved
                </span>
            </div>
        </footer>
    );
}
