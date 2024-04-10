import * as React from 'react'

import {cn} from '@/lib/utils'

const Input = React.forwardRef(({className, type, ...props}, ref) => {
    return (
        (<input
            type={type}
            className={cn(
                'font-sans tracking-wide flex h-10 w-full border border-cs-gray-1 bg-white px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-cs-gray-2 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring focus-visible:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 rounded-sm',
                className
            )}
            ref={ref}
            {...props} />)
    );
})
Input.displayName = 'Input'

export {Input}
