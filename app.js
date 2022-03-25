var app = new Vue({
    el: '#order-form',
    data: {
        shipping_data: 0,
        policy: 0,
        shipping_methods: [],
        payment_methods: [],
        message: '',
        products: [{
            id: 1,
            name: 'Testowy produkt',
            description: 'Testowy opis',
            image: 'Assets/Product/TestowyProdukt.jpg',
            quantity: 1,
            price: 115.00
        }],
        formData: {
            create_account: 0,
            username: '',
            password: '',
            confirm_password: '',
            first_name: '',
            last_name: '',
            email: '',
            billing_country: '',
            billing_city: '',
            billing_address: '',
            billing_postal_code: '',
            shipping_country: '',
            shipping_city: '',
            shipping_address: '',
            shipping_postal_code: '',
            phone: '',
            comment: '',
            shipping_id: '',
            payment_id: '',
            newsletter: 0
        },
        errors: {
            first_name: false,
            last_name: false,
            email: false,
            billing_country: false,
            billing_city: false,
            billing_address: false,
            billing_postal_code: false,
            shipping_country: false,
            shipping_city: false,
            shipping_address: false,
            shipping_postal_code: false,
            phone: false,
            comment: false,
            shipping_id: false,
            payment_id: false,
        }
    },
    methods: {
        processForm: function () {
            const formData = new FormData();
            Object.entries(this.formData).forEach(([key, value]) => {
                formData.append(key, value);
            });
            formData.append('products', JSON.stringify(this.products))
            if (this.validateFormData()) {
                axios.post("app.php", formData).then((res) => {
                    console.log(res['data'])
                    this.message = "Dziękujemy za złożenie zamówienia nr " + res['data'] + ".";
                    this.clearForm();
                })
            } else {
                alert("Wystąpił błąd\nSprawdź dane w formularzu.")
            }

        },
        loadPaymentOptions: function () {
            const formData = new FormData();
            formData.append('shipping_id', this.formData.shipping_id)
            axios.post("getPaymentOptions.php", formData).then((res) => {
                this.payment_methods = [];
                this.payment_methods = res['data'];
            })
        },
        clearForm: function () {
            this.formData.create_account = 0;
            this.formData.username = '';
            this.formData.password = '';
            this.formData.confirm_password = '';
            this.formData.first_name = '';
            this.formData.last_name = '';
            this.formData.email = '';
            this.formData.billing_country = '';
            this.formData.billing_city = '';
            this.formData.billing_address = '';
            this.formData.billing_postal_code = '';
            this.formData.shipping_country = '';
            this.formData.shipping_city = '';
            this.formData.shipping_address = '';
            this.formData.shipping_postal_code = '';
            this.formData.phone = '';
            this.formData.comment = '';
            this.formData.shipping_id = '';
            this.formData.payment_id = '';
            this.formData.newsletter = 0;
            this.policy = 0;
            this.shipping_data = 0;
        },
        validateFormData: function () {
            const firstNameIsValid = !!this.formData.first_name
            const lastNameIsValid = !!this.formData.last_name
            const emailIsValid = !!this.formData.email
            const billingCountryIsValid = !!this.formData.billing_country
            const billingCityIsValid = !!this.formData.billing_city
            const billingAddressIsValid = !!this.formData.billing_address
            const billingPostalCodeIsValid = !!this.formData.billing_postal_code
            const phoneIsValid = !!this.formData.phone
            const shippingIdIsValid = !!this.formData.shipping_id
            const paymentIdIsValid = !!this.formData.payment_id
            const policyIsValid = !!this.policy
            return firstNameIsValid && lastNameIsValid && emailIsValid && billingCountryIsValid &&
                billingCityIsValid && billingAddressIsValid && billingPostalCodeIsValid && phoneIsValid &&
                shippingIdIsValid && paymentIdIsValid && policyIsValid
        }
    },
    computed: {
        total_cost() {
            return this.products.reduce((acc, item) => acc + item.price, 0);
        }
    },
    beforeMount() {
        axios.get("getShippingOptions.php").then(res => {
            this.shipping_methods = res['data'];
        });
    }
});