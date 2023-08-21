
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Cards</title>
    <style>
        /* Add your CSS styling here */
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div id="categories">
        <!-- Categories will be dynamically generated here -->
    </div>
    <div id="faq">
        <!-- FAQs will be displayed here when a category is selected -->
    </div>
    <script>
        // Sample data for categories, subcategories, and FAQs
        const data = [
            {
                category: "Category 1",
                subcategories: ["Subcategory 1.1", "Subcategory 1.2"],
                faqs: [
                    { question: "FAQ 1.1", answer: "Answer 1.1" },
                    { question: "FAQ 1.2", answer: "Answer 1.2" }
                ]
            },
            {
                category: "Category 2",
                subcategories: ["Subcategory 2.1", "Subcategory 2.2"],
                faqs: [
                    { question: "FAQ 2.1", answer: "Answer 2.1" },
                    { question: "FAQ 2.2", answer: "Answer 2.2" }
                ]
            }
            // Add more categories as needed
        ];

        // Function to generate category cards
        function generateCategoryCards() {
            const categoriesDiv = document.getElementById("categories");

            data.forEach((item, index) => {
                const categoryCard = document.createElement("div");
                categoryCard.className = "card";
                categoryCard.textContent = item.category;

                categoryCard.addEventListener("click", () => {
                    displayFAQs(index);
                });

                categoriesDiv.appendChild(categoryCard);
            });
        }

        // Function to display FAQs for a selected category
        function displayFAQs(index) {
            const faqDiv = document.getElementById("faq");
            faqDiv.innerHTML = ""; // Clear previous FAQs

            data[index].faqs.forEach(faq => {
                const faqCard = document.createElement("div");
                faqCard.className = "card";
                faqCard.innerHTML = `<strong>${faq.question}</strong><br>${faq.answer}`;
                faqDiv.appendChild(faqCard);
            });
        }

        // Generate category cards on page load
        generateCategoryCards();
    </script>
</body>
</html>
This code creates a simple web page with category cards. When you click on a category, it displays the FAQs for that category. You can expand and customize this code further to meet your specific design and functionality requirements.




User
give in html & css code for that
ChatGPT
Certainly, here's a simplified HTML and CSS code for creating multiple cards with categories, subcategories, and FAQs:

html
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Cards</title>
    <style>
        /* Add your CSS styling here */
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .category {
            font-size: 20px;
            font-weight: bold;
        }

        .subcategory {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .faq {
            margin-top: 10px;
        }

        .faq-question {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="category">Category 1</div>
        <div class="subcategory">Subcategory 1.1</div>
        <div class="faq">
            <div class="faq-question">FAQ 1.1.1</div>
            <div>Answer to FAQ 1.1.1</div>
        </div>
        <div class="faq">
            <div class="faq-question">FAQ 1.1.2</div>
            <div>Answer to FAQ 1.1.2</div>
        </div>
        <!-- Add more subcategories and FAQs as needed -->
    </div>

    <div class="card">
        <div class="category">Category 2</div>
        <div class="subcategory">Subcategory 2.1</div>
        <div class="faq">
            <div class="faq-question">FAQ 2.1.1</div>
            <div>Answer to FAQ 2.1.1</div>
        </div>
        <div class="subcategory">Subcategory 2.2</div>
        <div class="faq">
            <div class="faq-question">FAQ 2.2.1</div>
            <div>Answer to FAQ 2.2.1</div>
        </div>
        <!-- Add more subcategories and FAQs as needed -->
    </div>

    <!-- Add more category cards as needed -->
</body>
</html>