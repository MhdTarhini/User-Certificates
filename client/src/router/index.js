import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import DashboardView from '../views/DashboardView.vue'
import AdminView from '../views/AdminView.vue'
import LayoutView from '../views/LayoutView.vue'
import EditProfileView from '../views/EditProfileView.vue'
import AddCertificateView from '../views/addCertificateView.vue'
import CertificatesReportView from '../views/CertificatesReportView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/v1',
      component: LayoutView,
      children: [
        {
          path: '',
          name: 'Dashboard',
          component: DashboardView
        },
        {
          path: '/add-certificate',
          name: 'addCertificate',
          component: AddCertificateView
        },
        {
          path: '/edit-profile',
          name: 'EditProfile',
          component: EditProfileView
        }
      ]
    },
    {
      path: '/admin',
      component: LayoutView,
      children: [
        {
          path: '',
          name: 'AdminDashboard',
          component: AdminView
        },
        {
          path: '/certificates_report',
          name: 'CertificatesReport',
          component: CertificatesReportView
        },
        {
          path: '/edit-profile',
          name: 'EditProfile',
          component: EditProfileView
        }
      ]
    }
  ]
})

export default router
