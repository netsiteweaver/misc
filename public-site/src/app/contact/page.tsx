import { Button } from "@/components/Button";
import { Container } from "@/components/Container";
import { fetchSiteSettings } from "@/lib/api";
import { QuoteRequestForm } from "@/components/QuoteRequestForm";

export const metadata = {
  title: "Contact",
  description: "Request a quote for car parts via Facebook or email.",
};

function buildQuoteMessage() {
  return [
    "Hi! I'd like a quote for a car part.",
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

export default async function ContactPage() {
  let site = {
    email: "",
    facebookUrl: "https://www.facebook.com/profile.php?id=100068333531889",
  };

  try {
    site = await fetchSiteSettings();
  } catch (error) {
    console.error("Failed to fetch site settings:", error);
  }

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
          car details and a photo of the old part. Or use the form below.
        </p>

        <div className="mt-6 flex flex-col gap-3 sm:flex-row">
          <Button href={site.facebookUrl} external>
            Message us on Facebook
          </Button>
          {mailto ? (
            <Button href={mailto} external variant="secondary">
              Email request
            </Button>
          ) : null}
        </div>

        <div className="mt-10 rounded-2xl border border-zinc-200 bg-white p-6">
          <h2 className="text-lg font-semibold text-zinc-900">
            Request a Quote
          </h2>
          <p className="mt-1 text-sm text-zinc-600">
            Fill out the form below and we'll get back to you soon.
          </p>
          <div className="mt-6">
            <QuoteRequestForm />
          </div>
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

