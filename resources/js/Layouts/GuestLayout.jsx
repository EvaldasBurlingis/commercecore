import Footer from '@/Components/Footer.jsx';

export default function Guest({children}) {
    return (
        <div className="min-h-screen flex flex-col">
            <div className={'flex-1'}>
                {children}
            </div>
            <Footer/>
        </div>
    );
}
