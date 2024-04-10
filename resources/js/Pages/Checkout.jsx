import {Head, useForm} from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';
import CheckoutMobileSummary from '@/Components/CheckoutMobileSummary.jsx';
import {useEffect, useState} from 'react';
import {Card} from '@/Components/ui/card';
import InputError from '@/Components/InputError.jsx';
import {Input} from '@/Components/ui/input';
import {Button} from '@/Components/ui/button.jsx';
import CountrySelect from '@/Components/form/CountrySelect.jsx';
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from '@/Components/ui/select.jsx';

export default function Checkout({cart}) {
    const [checkoutCart, setCheckoutCart] = useState({
        total: 0, items: [],
    })

    const [countryStates, setCountryStates] = useState([])
    const {data, setData, post, processing, errors} = useForm({
        customer_first_name: '',
        customer_last_name: '',
        customer_address: '',
        customer_country: '',
        customer_state: '',
        customer_postal_code: '',
        cc_number: '',
        cc_expiration_date: '',
        cc_cvv: '',
    })

    useEffect(() => {
        if (cart) {
            setCheckoutCart(cart)
        }
    }, [])

    const handleSubmit = (e) => {
        e.preventDefault();

        post(route('cart.checkout', {id: checkoutCart.id}))
    }

    const handleRemoveCartItem = async (id) => {
        await axios.delete(route('api.cart.item.delete', {cart: checkoutCart.id, item: id})).then(response => {
            setCheckoutCart(response.data.data)
        })
    }

    const handleCountrySelect = async (country) => {
        setData({
            ...data, customer_country: country, customer_state: ''
        })

        let countryFormatted = country.toLowerCase().replace(' ', '_')

        axios.get(route('api.countries.states.index', {country: countryFormatted})).then(response => {
            setCountryStates(response.data.data)
        })
    }

    const handleExpirationDateChange = (e) => {
        let value = e.target.value;
        value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        if (value.length > 2) {
            value = value.slice(0, 2) + '/' + value.slice(2); // Add slash after 2 digits
        }
        if (value.length > 5) {
            value = value.slice(0, 5); // Limit length to 5 characters (MM/YY)
        }
        setData('cc_expiration_date', value);
    }

    return (<GuestLayout>
        <Head title="Checkout"/>
        <div className={'pt-16 lg:pt-0'}>
            <CheckoutMobileSummary cart={checkoutCart} handleRemoveCartItem={handleRemoveCartItem}/>
            <div className={'flex'}>
                <section className={'py-8 px-4 font-sans w-full lg:w-7/12 lg:ml-32 lg:pr-16 lg:pt-20'}>
                    <div>
                        <h2 className={'text-xs tracking-wide font-bold mb-2'}>PAYMENT AND SHIPPING</h2>
                        <Card className={'bg-white py-5 px-4 border border-footer-border-1 rounded-none'}>
                            <form onSubmit={handleSubmit}>
                                <div>
                                    <div className={'mb-4'}>
                                        <h3 className={'font-work-sans text-sm font-medium tracking-wide mb-1'}>Customer
                                            Information</h3>
                                        <p className={'text-xs text-cs-gray-2'}>Fields marked as (*) are required.</p>
                                    </div>

                                    <div className={'lg:flex'}>
                                        <div className={'mb-4 lg:w-1/2 lg:mr-4'}>
                                            <Input id={'customer_first_name'}
                                                   value={data.customer_first_name}
                                                   onChange={(e) => setData('customer_first_name', e.target.value)}
                                                   required
                                                   isFocused
                                                   placeholder={'First Name*'}
                                                   autoComplete={'customer_first_name'}/>
                                            <InputError className={'mt-1'} message={errors.customer_first_name}/>
                                        </div>
                                        <div className={'mb-4 lg:w-1/2'}>
                                            <Input id={'customer_last_name'}
                                                   value={data.customer_last_name}
                                                   onChange={(e) => setData('customer_last_name', e.target.value)}
                                                   required
                                                   isFocused
                                                   placeholder={'Last Name*'}
                                                   autoComplete={'customer_last_name'}/>
                                            <InputError className={'mt-1'} message={errors.customer_last_name}/>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div className={'mb-4'}>
                                        <h3 className={'font-work-sans text-sm font-medium tracking-wide'}>Customer
                                            Information</h3>
                                    </div>
                                    <div className={'mb-4'}>
                                        <Input id={'customer_address'}
                                               value={data.customer_address}
                                               onChange={(e) => setData('customer_address', e.target.value)}
                                               required
                                               isFocused
                                               placeholder={'Address*'}
                                               autoComplete={'customer_address'}/>
                                        <InputError className={'mt-1'} message={errors.customer_address}/>
                                    </div>
                                    <div className={'lg:flex'}>
                                        <div className={'mb-4 lg:w-1/3 lg:mr-4'}>
                                            <CountrySelect onChange={handleCountrySelect}/>
                                            <InputError className={'mt-1'} message={errors.customer_country}/>
                                        </div>
                                        <div className={'mb-4 lg:w-1/3 lg:mr-4'}>
                                            <Select
                                                onValueChange={(field) => setData('customer_state', field)}
                                                disabled={countryStates.length <= 0}>
                                                <SelectTrigger>
                                                    <SelectValue placeholder={'State*'}/>
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {countryStates.map(countryState => {
                                                        return <SelectItem key={countryState.code}
                                                                           value={countryState.name}>{countryState.name}</SelectItem>
                                                    })}
                                                </SelectContent>
                                            </Select>
                                            <InputError className={'mt-1'} message={errors.customer_state}/>
                                        </div>
                                        <div className={'mb-4 lg:w-1/3'}>
                                            <Input id={'customer_postal_code'}
                                                   value={data.customer_postal_code}
                                                   onChange={(e) => setData('customer_postal_code', e.target.value)}
                                                   required
                                                   isFocused
                                                   placeholder={'Postal Code*'}
                                                   autoComplete={'customer_postal_code'}/>
                                            <InputError className={'mt-1'} message={errors.customer_postal_code}/>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <div className={'mb-4'}>
                                        <h3 className={'font-work-sans text-sm font-medium tracking-wide'}>Payment
                                            Method</h3>
                                    </div>
                                    <div className={'border mb-4 rounded-sm'}>
                                        <div className={'p-4'}>
                                            <h4>Credit Card</h4>
                                        </div>
                                        <div className={'bg-zinc-50 p-4 border-t border-cs-gray-1'}>
                                            <div className={'mb-4'}>
                                                <Input id={'cc_number'}
                                                       value={data.cc_number}
                                                       onChange={(e) => setData('cc_number', e.target.value)}
                                                       type={'number'}
                                                       required
                                                       isFocused
                                                       placeholder={'Card Number'}
                                                       autoComplete={'cc_number'}/>
                                                <InputError className={'mt-1'} message={errors.cc_number}/>
                                            </div>
                                            <div className={'flex'}>
                                                <div className={'mr-2 w-1/2 lg:w-1/4'}>
                                                    <Input id={'cc_expiration_date'}
                                                           value={data.cc_expiration_date}
                                                           onChange={handleExpirationDateChange}
                                                           required
                                                           isFocused
                                                           placeholder={'MM/YY'}
                                                           className={'block'}
                                                           autoComplete={'cc_expiration_date'}/>
                                                    <InputError className={'mt-1'} message={errors.cc_expiration_date}/>
                                                </div>
                                                <div className={'w-1/2 lg:w-1/4'}>
                                                    <Input id={'cc_cvv'}
                                                           className={'block'}
                                                           type={'number'}
                                                           value={data.cc_cvv}
                                                           onChange={(e) => setData('cc_cvv', e.target.value)}
                                                           required
                                                           isFocused
                                                           placeholder={'CVV'}
                                                           autoComplete={'cc_cvv'}/>
                                                    <InputError className={'mt-1'} message={errors.cc_cvv}/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <Button onClick={handleSubmit} variant={'checkout'} className={'w-full'} size={'xl'}
                                        disabled={processing || checkoutCart.items.length <= 0}>COMPLETE
                                    ORDER</Button>

                                <div className={'flex justify-center'}>
                                    <img src="https://placehold.jp/91x49.png" className={'my-4 mx-2 w-1/4 lg:max-w-24'}
                                         alt=""/>
                                    <img src="https://placehold.jp/91x49.png" className={'my-4 mx-2 w-1/4 lg:max-w-24'}
                                         alt=""/>
                                    <img src="https://placehold.jp/91x49.png" className={'my-4 mx-2 w-1/4 lg:max-w-24'}
                                         alt=""/>
                                    <img src="https://placehold.jp/91x49.png" className={'my-4 mx-2 w-1/4 lg:max-w-24'}
                                         alt=""/>
                                </div>
                            </form>
                        </Card>
                    </div>
                </section>
                <section className={'hidden lg:block lg:w-5/12 bg-white lg:pt-28 lg:pl-16 lg:pr-32'}>
                    {checkoutCart.items.map((cartItem, index) => (<div key={cartItem.id}>
                        <div
                            className={`cart-item transition-all duration-200 flex justify-between items-center ${index === 0 ? 'pb-4' : 'py-4'}`}>
                            <div className={'w-1/6'}><img src="https://placehold.jp/72x72.png" alt=""/></div>
                            <div className={'w-4/6 text-sm ml-5 m'}>
                                <div className={'mb-1'}>
                                    <span className={'font-bold'}>{cartItem.quantity}x</span>
                                    <span className={'font-light ml-1'}>{cartItem.name}</span>
                                </div>
                                <div
                                    className={'text-xs font-light cursor-pointer remove-cart-item-btn'}
                                    onClick={() => handleRemoveCartItem(cartItem.id)}>x Remove
                                </div>
                            </div>
                            <div className={'text-sm'}>${cartItem.quantity * cartItem.price}</div>
                        </div>
                        {index < checkoutCart.items.length - 1 && <hr/>}
                    </div>))}
                    {cart.items.length > 0 && <hr/>}
                    <div className={'flex justify-between pt-4 text-base'}>
                        <div className={'text-footer-gray-1 font-light'}>Total</div>
                        <div>
                            <span className={'mr-2 text-xs'}>USD</span>
                            <span className={'text-base font-bold'}>${checkoutCart.total}</span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </GuestLayout>);
}
