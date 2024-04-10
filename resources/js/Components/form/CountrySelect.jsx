import {Select, SelectContent, SelectItem, SelectSeparator, SelectTrigger, SelectValue,} from '@/Components/ui/select'
import {useEffect, useState} from 'react';

export default function CountrySelect({onChange}) {
    const [countries, setCountries] = useState([])

    useEffect(() => {
        axios.get(route('api.countries.index')).then(response => {
            setCountries(response.data.data)
        })

    }, [])

    return (
        <Select onValueChange={(field) => onChange(field)}>
            <SelectTrigger>
                <SelectValue placeholder={'Country*'}/>
            </SelectTrigger>
            <SelectContent>
                <SelectSeparator/>
                {countries.map(country => {
                    return <SelectItem key={country.code} value={country.name}>{country.name}</SelectItem>
                })}
            </SelectContent>
        </Select>
    )
}
