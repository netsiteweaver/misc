import { Button } from "@/components/Button";
import { Container } from "@/components/Container";
import { site } from "@/lib/site";

export const metadata = {
  title: "Contact",
  description: "Request a quote for car parts via Facebook or email.",
};

function buildQuoteMessage() {
  return [
    "Hi! I’d like a quote for a car part.",
    "",
    "Car: (make/model/year)",
    "Engine: (optional)",
    "Part needed: (name)",
    "Qty: (1)",
    "Any photo of old part: (attach)",
    "",
    "Thank you.",
  ].join("\n");
}

export default function ContactPage() {
  const message = buildQuoteMessage();
  const mailto =
    site.email && site.email.trim().length > 0
      ? `mailto:${encodeURIComponent(site.email)}?subject=${encodeURIComponent(
          "Car parts quote request",
        )}&body=${encodeURIComponent(message)}`
      : "";

  return (
    <Container className="py-10 sm:py-14">
      <div className="max-w-2xl">
        <h1 className="text-3xl font-semibold tracking-tight sm:text-4xl">
          Contact
        </h1>
        <p className="mt-3 text-zinc-600">
          The fastest way to get a quote is to message us on Facebook with your
          car details and a photo of the old part.
        </p>

        <div className="mt-6 flex flex-col gap-3 sm:flex-row">
          <Button href={site.facebookUrl} external>
            Message us on Facebook
          </Button>
          {mailto ? (
            <Button href={mailto} external variant="secondary">
              Email request
            </Button>
          ) : (
            <Button href={site.facebookUrl} external variant="secondary">
              (Add email later)
            </Button>
          )}
        </div>

        <div className="mt-10 rounded-2xl border border-zinc-200 bg-white p-5">
          <div className="text-sm font-semibold">What to send (copy/paste)</div>
          <pre className="mt-3 whitespace-pre-wrap rounded-xl bg-zinc-50 p-4 text-sm text-zinc-700">
            {message}
          </pre>
          <p className="mt-3 text-xs text-zinc-500">
            Tip: Photos of the part number label help a lot.
          </p>
        </div>
      </div>
    </Container>
  );
}

