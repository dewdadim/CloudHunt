import { type VariantProps, cva } from 'class-variance-authority'

export { default as Button } from './Button.vue'

export const buttonVariants = cva(
  'inline-flex items-center justify-center whitespace-nowrap rounded-xl border text-sm font-normal ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50',
  {
    variants: {
      variant: {
        default: 'bg-primary text-primary-foreground hover:bg-primary/90',
        destructive:
          'bg-destructive text-destructive-foreground hover:bg-destructive/90',
        outline:
          'bg-null !shadow-none hover:bg-accent/50 hover:text-accent-foreground',
        secondary: 'bg-white text-secondary-foreground hover:bg-secondary/80',
        ghost:
          'hover:bg-accent/50 hover:text-accent-foreground border-0 !shadow-none',
        link: 'text-primary-foreground underline-offset-4 border-0 !shadow-none hover:underline',
      },
      size: {
        default: 'h-10 px-4 py-2',
        xs: 'h-7 rounded-xl px-2',
        sm: 'h-9 rounded-xl px-3',
        lg: 'h-11 rounded-xl px-8 shadow-lg font-medium',
        icon: 'h-10 w-10',
      },
    },
    defaultVariants: {
      variant: 'default',
      size: 'default',
    },
  },
)

export type ButtonVariants = VariantProps<typeof buttonVariants>
