import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Admin from "../views/Admin.vue";
//------------------------------- Payment Routes ------------------------------------- 
import Payments from "../views/payment/admin/Payments.vue";
import GiftCards from "../views/payment/admin/GiftCards.vue";
import Paypal from "../views/payment/admin/Paypal.vue";
import AddGiftCard from "../views/payment/admin/AddGiftCard.vue";
import AddPaypal from "../views/payment/admin/AddPaypal.vue";
import updateGiftCard from "../views/payment/admin/updateGiftCard.vue";
import updatePaypal from "../views/payment/admin/updatePaypal.vue";
import Transactions from "../views/payment/admin/Transactions.vue";
import Refunds from "../views/payment/admin/Refunds.vue";
import Authorizations from "../views/payment/admin/Authorizations.vue";
import makePayment from "../views/payment/website/makePayment.vue";
import paymentPaypal from "../views/payment/website/paymentPaypal.vue";
import Catalogs from "../views/catalog/admin/Catalogs.vue";
import CatalogProducts from "../views/catalog/admin/CatalogProducts2.vue";
import deleteProductFromCatalog from "../views/catalog/admin/deleteProductFromCatalog.vue";
import AddCatalog from "../views/catalog/admin/AddCatalog.vue";
import updateCatalog from "../views/catalog/admin/updateCatalog.vue";
import homeCatalog from "../views/catalog/website/Catalogs.vue";
import redirect from "../views/catalog/website/redirect.vue";
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/makePayment",
    name: "makePayment",
    component: makePayment
  },
  {
    path: "/paymentPaypal",
    name: "paymentPaypal",
    component: paymentPaypal
  },
  {
    path: "/admin",
    name: "Admin",
    component: Admin
  },
  {
    path: "/admin/payments",
    name: "Payments",
    component: Payments
  },
  {
    path: "/admin/payments/giftcards",
    name: "GiftCards",
    component: GiftCards
  },
  {
    path: "/admin/payments/paypal",
    name: "Paypal",
    component: Paypal
  },
  {
    path: "/admin/payments/giftcards/add",
    name: "AddGiftCard",
    component: AddGiftCard
  },
  {
    path: "/admin/payments/paypal/add",
    name: "AddPaypal",
    component: AddPaypal
  },
  {
    path: "/admin/payments/giftcards/update/:id",
    name: "updateGiftCard",
    component: updateGiftCard
  },
  {
    path: "/admin/payments/paypal/update/:id",
    name: "updatePaypal",
    component: updatePaypal
  },
  {
    path: "/admin/payments/transactions",
    name: "Transactions",
    component: Transactions
  },
  {
    path: "/admin/payments/refunds",
    name: "Refunds",
    component: Refunds
  },
  {
    path: "/admin/payments/authorizations",
    name: "Authorizations",
    component: Authorizations
  },
  {
    path: "/admin/catalog",
    name: "Catalogs",
    component: Catalogs
  },
  {
    path: "/admin/catalog/add",
    name: "AddCatalog",
    component: AddCatalog
  },
  {
    path: "/admin/catalog/update/:id",
    name: "updateCatalog",
    component: updateCatalog
  }
  ,
  {
    path: "/admin/catalog/CatalogProducts",
    name: "CatalogProducts",
    component: CatalogProducts
  },
  {
    path: "/admin/catalog/deleteProductFromCatalog",
    name: "deleteProductFromCatalog",
    component: deleteProductFromCatalog
  },
  {
    path: "/home/catalog/:id",
    name: "homeCatalog",
    component: homeCatalog
  }
  ,
  {
    path: "/redirect/:id",
    name: "redirect",
    component: redirect
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
