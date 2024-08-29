$(document).ready(function () {
    const stripe = Stripe(stripeKey);
    let elements;
    let paymentElement;

    $("#payment-form-container").hide(true);

    async function initializePayment(productId) {
        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        try {
            const response = await fetch(
                `/create-checkout-session-ajax/${productId}`,
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }
            );

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const { clientSecret, amount, currency } = await response.json();
            

            if (!clientSecret) {
                throw new Error("Client secret is missing from the response");
            }

            elements = stripe.elements({ clientSecret });

            const paymentElementOptions = {
                layout: "auto",
            };

            if (paymentElement) {
                paymentElement.unmount();
            }
            
            paymentElement = elements.create("payment", paymentElementOptions);
            
            const amountFormatted = (amount / 100).toFixed(2); 
            
            $('.payment-price').text(`${currency.toUpperCase()} ${amountFormatted}`);
            
            paymentElement.mount("#payment-element");
            

            $("#submit-button")
                .on("click", async function () {
                    const { error } = await stripe.confirmPayment({
                        elements,
                        confirmParams: {
                            return_url: window.location.origin + "/successlocal",
                        },
                    });

                    if (error) {
                        $("#payment-message")
                            .text(error.message)
                            .removeClass("hidden");
                    }
                });
        } catch (error) {
            console.error("Error initializing Stripe Elements:", error);
        }
    }

    $(document).on("click", "#show-button-form", function () {
        const productId = $(this).data("product-id");
        $("#payment-form-container").show(true);
        initializePayment(productId);
    });

    $(document).on("click", ".close-button-form", function () {
        $("#payment-form-container").hide(true);
    });
});
