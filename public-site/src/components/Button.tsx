import Link from "next/link";
import type { ReactNode, ButtonHTMLAttributes } from "react";

type BaseProps = {
  children: ReactNode;
  variant?: "primary" | "secondary";
  className?: string;
};

type LinkProps = BaseProps & {
  href: string;
  external?: boolean;
  type?: never;
  disabled?: never;
};

type ButtonProps = BaseProps & {
  href?: never;
  external?: never;
  type?: ButtonHTMLAttributes<HTMLButtonElement>["type"];
  disabled?: boolean;
};

type Props = LinkProps | ButtonProps;

export function Button({
  children,
  variant = "primary",
  className = "",
  ...props
}: Props) {
  const base =
    "inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-900/30";
  const styles =
    variant === "primary"
      ? "bg-zinc-900 text-white hover:bg-zinc-800"
      : "bg-white text-zinc-900 ring-1 ring-zinc-200 hover:bg-zinc-50";

  // If href is provided, render as Link
  if ("href" in props && props.href) {
    if (props.external) {
      return (
        <a
          href={props.href}
          target="_blank"
          rel="noopener noreferrer"
          className={`${base} ${styles} ${className}`}
        >
          {children}
        </a>
      );
    }

    return (
      <Link href={props.href} className={`${base} ${styles} ${className}`}>
        {children}
      </Link>
    );
  }

  // Otherwise, render as button element
  return (
    <button
      type={props.type || "button"}
      disabled={props.disabled}
      className={`${base} ${styles} ${className} ${props.disabled ? "opacity-50 cursor-not-allowed" : ""}`}
    >
      {children}
    </button>
  );
}

