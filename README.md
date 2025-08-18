# 🚀 VoucherBoost - Ultimate Coupon & Affiliate Platform

<p align="center">
  <a href="https://voucherboost.com" target="_blank">
    <img src="/public/images/voucherboost.PNG" width="800" alt="VoucherBoost Banner">
  </a>
  <br>
  <strong>Live URL: </strong> <a href="https://voucherboost.com" target="_blank">https://voucherboost.com</a>
</p>

<div align="center">
  <img src="https://img.shields.io/badge/Live-Production-brightgreen" alt="Live Status">
  <img src="https://img.shields.io/github/last-commit/hasnain2001/VoucherBoost" alt="Last Commit">
  <img src="https://img.shields.io/badge/License-MIT-blue" alt="License">
</div>

---

## ✨ Premium Features

<div align="center">
  <table>
    <tr>
      <td width="50%">
        <h3>👑 Multi-Tier Access System</h3>
        <ul>
          <li><b>Admin:</b> Full analytics dashboard + user management</li>
          <li><b>Employee:</b> Store-specific coupon moderation</li>
          <li><b>User:</b> Personalized deal recommendations</li>
        </ul>
      </td>
      <td width="50%">
        <h3>💎 Exclusive Tools</h3>
        <ul>
          <li>Store check-ins with GPS verification</li>
          <li>AI-powered coupon matching</li>
          <li>Commission tracking for affiliates</li>
        </ul>
      </td>
    </tr>
  </table>
</div>

---

## 🛠️ Technology Ecosystem

<div align="center">
  <img src="https://skillicons.dev/icons?i=laravel,php,bootstrap,css,javascript,mysql,pusher&perline=7" alt="Tech Stack">
</div>

---

## 🎨 Visual Showcase

<div align="center">
  <h3>✨ Platform Highlights</h3>
  <table>
    <tr>
      <td><img src="/public/images/admin.PNG" width="100%" alt="Admin Dashboard"></td>
      <td><img src="/public/images/user.PNG" width="100%" alt="User Interface"></td>
    </tr>
    <tr>
      <td colspan="2"><img src="/public/images/employee.PNG" width="60%" alt="Employee Portal"></td>
    </tr>
  </table>
</div>

---

## 🚀 Quick Deployment

```bash
# 1. Clone repository
git clone https://github.com/hasnain2001/voucherboost.com
cd VoucherBoost.com

# 2. Install dependencies
composer install && npm install

# 3. Configure environment
#for linux
cp .env.example .env
#for windows
copy .env.example .env
php artisan key:generate

# 4. Database setup (edit .env)
DB_DATABASE=voucherboost
DB_USERNAME=root
DB_PASSWORD=

# 5. Run migrations
php artisan migrate 

# 6. Start development server
php artisan serve
composer run dev 
