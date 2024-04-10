import {useState} from 'react';
import {ChevronRight} from 'lucide-react';
import ShoppingCart from '@/Components/icons/ShoppingCart';

export default function CheckoutMobileSummary({cart, handleRemoveCartItem}) {
    const [isExpanded, setIsExpanded] = useState(false);

    const handleToggle = () => setIsExpanded(!isExpanded);

    return (<div className={'lg:hidden'}>
        <div onClick={handleToggle}
             className={'flex justify-between p-4 bg-white border-b border-footer-border cursor-pointer absolute w-full top-0 z-10 h-16'}>
            <div className={'flex items-center text-sm'}>
                <ShoppingCart className="h-4 w-4"/>
                <span className={'mx-2 font-bold tracking-wider'}>ORDER SUMMARY</span>
                <ChevronRight
                    className={`h-4 w-4 shrink-0 transition-transform duration-200 ${isExpanded ? '-rotate-90' : ''}`}/>
            </div>
            <div className={'font-bold'}>${cart.total}</div>
        </div>
        <div
            className={`${!isExpanded ? '-translate-y-64' : 'translate-y-0'} bg-white p-4 absolute w-full shadow-xl transition-all duration-200`}>
            {cart.items.map((cartItem, index) => (<div key={cartItem.id}>
                <div className={`flex justify-between items-center ${index === 0 ? 'pb-4' : 'py-4'}`}>
                    <div className={'w-1/6'}><img src="https://placehold.jp/58x59.png" alt=""/></div>
                    <div className={'w-4/6 text-sm ml-5'}>
                        <div className={'mb-1'}>
                            <span className={'font-bold'}>{cartItem.quantity}x</span>
                            <span className={'font-light ml-1'}>{cartItem.name}</span>
                        </div>
                        <div className={'text-xs font-light text-red-600 cursor-pointer'}
                             onClick={() => handleRemoveCartItem(cartItem.id)}>x Remove
                        </div>
                    </div>
                    <div className={'text-sm'}>${cartItem.quantity * cartItem.price}</div>
                </div>
                {index < cart.items.length - 1 && <hr/>}
            </div>))}
            {cart.items.length > 0 && <hr/>}
            <div className={'flex justify-between pt-4 text-base'}>
                <div className={'text-footer-gray-1 font-light'}>Total</div>
                <div>
                    <span className={'mr-2 text-xs'}>USD</span>
                    <span className={'text-base font-bold'}>${cart.total}</span>
                </div>
            </div>
        </div>
    </div>);
}
