import axios from 'axios'

const API_BASE_URL = 'http://127.0.0.1:8000/api'

export const useAxios = () => {
  const token = localStorage.getItem('token') || ''
  const authAxios = axios.create({
    baseURL: API_BASE_URL,
    headers: { Authorization: `Bearer ${token}` }
  })

  const AddAndUpdateUserInfoAPI = async (userData, mode) => {
    const response = await authAxios.post(`/guest/register/${mode}`, userData)
    return response
  }

  const loginAPI = async (userData) => {
    const response = await authAxios.post(`/guest/login`, userData)
    return response
  }

  const logoutAPI = async () => {
    const response = await authAxios.post(`/logout`)
    return response
  }
  const getCertificateTypesAPI = async () => {
    const response = await authAxios.get(`/certificate/certificate_types`)
    return response
  }

  const addCertificateAPI = async (certificateDetails) => {
    const response = await authAxios.post(`/certificate/add_certificate`, certificateDetails)
    return response
  }
  const getUserCertificates = async () => {
    const response = await authAxios.get(`/certificate/get_user_certificates`)
    return response
  }

  const deleteUserCertificates = async (certificateId) => {
    const response = await authAxios.delete(`/certificate/delete_user_certificate/${certificateId}`)
    return response
  }

  const getUsersReportAPI = async () => {
    const response = await authAxios.get(`/admin/get_users_report`)
    return response
  }
  const approveUserAPI = async (userId) => {
    const response = await authAxios.get(`/admin/approve_user/${userId}`)
    return response
  }
  const addNewCertificateTypeAPI = async (certificateType) => {
    const response = await authAxios.get(`/admin/new_certificate_type/${certificateType}`)
    return response
  }
  const getCertificatesReportAPI = async () => {
    const response = await authAxios.get(`/admin/certificate_report`)
    return response
  }

  return {
    AddAndUpdateUserInfoAPI,
    loginAPI,
    logoutAPI,
    getCertificateTypesAPI,
    addCertificateAPI,
    getUserCertificates,
    deleteUserCertificates,
    getUsersReportAPI,
    approveUserAPI,
    addNewCertificateTypeAPI,
    getCertificatesReportAPI
  }
}
