<script src="<?= BASE_URL?>assets/user/theme_shop/assets/js/plugins.js"></script>

<!-- Main JS -->
<script src="<?= BASE_URL?>assets/user/theme_shop/assets/js/main.js"></script>
<!--  -->
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingStars = [...document.getElementsByClassName('commentstar')];
            const ratingValue = document.getElementById('rating-value');
            const form = document.getElementById('rating-form');

            ratingStars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    ratingStars.forEach((s, i) => {
                        if (i <= index) {
                            s.style.color = 'gold';
                        } else {
                            s.style.color = 'gray';
                        }
                    });
                    ratingValue.value = index + 1;
                });
            });

        });
    </script>
        <script>
        const data = <?php echo json_encode($data); ?>;
        console.log(data);
        const form = document.getElementById('variant-form');
        
        const variantInfo = document.getElementById('variant-info');

        form.addEventListener('change', () => {
            const formData = new FormData(form);
            const selectedAttributes = {};

            formData.forEach((value, key) => {
                selectedAttributes[key] = value;
            });

            const selectedVariant = findVariant(selectedAttributes);

            if (selectedVariant) {
                variantInfo.innerHTML = `
                    <h3>Thông tin biến thể:</h3>
                    <p>Giá: ${selectedVariant.price}</p>
                    <p>Giá khuyến mãi: ${selectedVariant.sale_price}</p>
                    <p>Số lượng: ${selectedVariant.quantity}</p>
                `;
            } else {
                variantInfo.innerHTML = '<p>Chưa chọn đủ thuộc tính.</p>';
            }
        });

        function findVariant(selectedAttributes) {
            for (const variant of Object.values(data)) {
                const attributes = {};
                for (const item of variant) {
                    if (!attributes[item.attribute_name]) {
                        attributes[item.attribute_name] = [];
                    }
                    attributes[item.attribute_name].push(item.attribute_value_id);
                }

                let match = true;
                for (const [attribute, value] of Object.entries(selectedAttributes)) {
                    if (!attributes[attribute] || !attributes[attribute].includes(parseInt(value))) {
                        match = false;
                        break;
                    }
                }

                if (match) {
                    return variant[0];
                }
            }
            return null;
        }
    </script>