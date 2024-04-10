import {Head, Link} from '@inertiajs/react';
import {buttonVariants} from '@/Components/ui/button';

export default function Welcome() {

    return (
        <>
            <Head title="Welcome"/>
            <Link href={route('checkout')} className={buttonVariants({variant: 'default'})}>Go to checkout</Link>
        </>
    );
}
