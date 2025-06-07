  # R8PC - Your PC Companion 💻🛠️

**Done By:**  
- Ali Mortada Anani 👨‍💻  
- Mohammad Merhi 👨‍💻  
- Omar Albarakeh 👨‍💻  
- Mohammad Fakih 👨‍💻

---

## Introduction 🚀

**R8PC (Rate PC)** is an online platform designed for buying, upgrading, and rating individual PC components, focusing on CPUs and GPUs. Whether you're a PC enthusiast or a casual user, R8PC provides a user-friendly experience to help you assess and improve your computer's performance.

---

## Key Features ⭐

- **Buy and Upgrade Components**  
  Search for CPUs, GPUs, and laptops. Receive personalized upgrade suggestions based on your current system.

- **Rate Component Performance**  
  Assess your PC components’ capabilities based on popular applications and games.

- **Relevant Statistics**  
  Access statistics highlighting the most recommended CPUs, GPUs, and RAM by experienced users.

- **User Authentication**  
  Secure login and signup to access the full range of features.

---

## System Requirements ⚙️
- **Web Server:**(XAMPP, WAMP, or similar) to host the application  
- **Web Browser:** Capable of running PHP projects 🌐  
- **Database:** MySQL 🗄️  
- **Code Editor:** Any code editor for potential customization ✍️

---

## Installation 🧩

### Step 1: Project Setup

1. Download the R8PC project files.  
2. Place the project folder inside the `htdocs` directory if you are using XAMPP.

### Step 2: Database Installation

**Option 1: Using PHP Pages**

- Create Database and Tables:  
  1. Open `DB_Functions.php` and set your MySQL password.  
  2. Navigate to:  
     `http://localhost/r8pc-php-project/R8PC/createdb.php`  
  This will create the database, tables, and initial data.

- Drop Database and Tables:  
  Navigate to:  
  `http://localhost/r8pc-php-project/R8PC/deletedb.php`

**Option 2: Using SQL Scripts**

- Create Database and Tables:  
  Execute the scripts in this order:  
  1. `CreateDatabase&Tables.sql`  
  2. `InsertData.sql`

- Drop Database and Tables:  
  Execute `DropDatabase.sql`

---

## Usage 🖥️

### Access the Application

Open your browser and go to:  
`http://localhost/r8pc-php-project/R8PC/2.php`

---

### User Authentication 🔐

- **Login:** Enter your credentials to access the platform.  
- **Signup:** For new users, click the "Signup" link, complete registration, then login with your new credentials.

---

### Home Page (PC Operations) 🏠

After login, you can:

- **Buy PC:** Browse CPUs, GPUs, and laptops within your budget.  
- **Upgrade PC:** Get personalized upgrade suggestions based on your current components and desired software.  
- **Rate PC:** Evaluate your PC’s performance with popular games and applications.  
- **Statistics:** View the most recommended components and laptops by experienced users.

---

### Buy PC Page 💰

- Enter your budget.  
- Select your favorite software/games.  
- Get recommendations for low, mid, and high-performance CPUs, GPUs, and laptops that fit your budget.

---

### Upgrade PC Page 🔧

- Enter desired software or games.  
- Enter your current CPU, GPU, and RAM.  
- Receive upgrade suggestions only if the recommended parts outperform your current components.

---

### Rate PC Page 📊

- Enter your PC components (CPU, GPU, RAM).  
- Submit to receive performance ratings categorized as:  
  - Compatible ✅  
  - Poor Performance ⚠️  
  - Good Enough 👍  
  - Great Performance 🌟

---

### Statistics Page 📈

View the most searched and recommended CPUs, GPUs, and laptops by experienced users.

---

## Contact 📞

If you face any issues during installation or usage, please contact: **81 090 816**

---

## Conclusion 🎉

R8PC empowers users to build, upgrade, and assess their PCs easily. Enjoy optimizing your components and contributing to the R8PC community!

---

**Enjoy using R8PC! 😄**
