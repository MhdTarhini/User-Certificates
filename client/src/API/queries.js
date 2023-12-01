import axios from 'axios'

const API_BASE_URL = 'http://127.0.0.1:8000/api'

export const useAxios = () => {
  const token = localStorage.getItem('token') || ''
  const authAxios = axios.create({
    baseURL: API_BASE_URL,
    headers: { Authorization: `Bearer ${token}` }
  })

  const registerAPI = async (userData) => {
    const response = await authAxios.post(`/guest/register`, userData)
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

  return {
    registerAPI,
    loginAPI,
    logoutAPI,
    getCertificateTypesAPI,
    addCertificateAPI
  }
}
