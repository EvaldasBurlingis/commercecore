/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: ['class'], content: ['./resources/js/**/*.jsx',], prefix: '', theme: {
        container: {
            center: true, padding: '2rem', screens: {
                '2xl': '1400px',
            },
        }, extend: {
            fontFamily: {
                'sans': ['Sofia Sans', 'sans-serif'],
                'work-sans': ['Work Sans', 'sans-serif'],
            }, colors: {
                border: 'hsl(var(--border))',
                input: 'hsl(var(--input))',
                ring: 'hsl(var(--ring))',
                background: 'hsl(var(--background))',
                foreground: 'hsl(var(--foreground))',
                footer: {
                    background: 'hsl(var(--footer-background))',
                    foreground: 'var(--footer-foreground)',
                    border: 'var(--footer-border)',
                    'gray-1': 'var(--footer-gray-1)',
                    'border-1': 'var(--footer-border-1)',
                },
                cs: {
                    'gray-1': 'var(--cs-gray-1)',
                    'gray-2': 'var(--cs-gray-2)',
                    'green-1': 'var(--cs-green-1)',
                    'green-1-hover': 'var(--cs-green-1-hover)',
                },
                primary: {
                    DEFAULT: 'hsl(var(--primary))', foreground: 'hsl(var(--primary-foreground))',
                },
                secondary: {
                    DEFAULT: 'hsl(var(--secondary))', foreground: 'hsl(var(--secondary-foreground))',
                },
                destructive: {
                    DEFAULT: 'hsl(var(--destructive))', foreground: 'hsl(var(--destructive-foreground))',
                },
                muted: {
                    DEFAULT: 'hsl(var(--muted))', foreground: 'hsl(var(--muted-foreground))',
                },
                accent: {
                    DEFAULT: 'hsl(var(--accent))', foreground: 'hsl(var(--accent-foreground))',
                },
                popover: {
                    DEFAULT: 'hsl(var(--popover))', foreground: 'hsl(var(--popover-foreground))',
                },
                card: {
                    DEFAULT: 'hsl(var(--card))', foreground: 'hsl(var(--card-foreground))',
                },
            }, borderRadius: {
                lg: 'var(--radius)', md: 'calc(var(--radius) - 2px)', sm: 'calc(var(--radius) - 4px)',
            }, keyframes: {
                'accordion-down': {
                    from: {
                        height: '0'
                    }, to: {
                        height: 'var(--radix-accordion-content-height)'
                    },
                }, 'accordion-up': {
                    from: {
                        height: 'var(--radix-accordion-content-height)'
                    }, to: {
                        height: '0'
                    },
                },
            }, animation: {
                'accordion-down': 'accordion-down 0.2s ease-out', 'accordion-up': 'accordion-up 0.2s ease-out',
            },
        },
    }, plugins: [require('tailwindcss-animate')],
}
