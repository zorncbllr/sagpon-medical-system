import { useMutation } from "@tanstack/react-query";
import { Patient, PatientError } from "../schemas/patient-interfaces";
import { axiosInstance } from "./api";
import { AxiosError } from "axios";
import useMultiFormStore from "../store/multiform-store";
import { useNavigate } from "react-router-dom";
import { LoginData } from "../components/auth/login-form";
import { UseFormSetError } from "react-hook-form";

interface LoginError {
  message: string;
  errors: {
    email?: string[];
    password?: string[];
  };
}

interface SuccessLogin {
  message: string;
  role: "admin" | "patient" | "doctor" | "nurse" | "staff";
  token: string;
  route: string;
}

export function useRegister() {
  const { setErrors } = useMultiFormStore();
  const navigate = useNavigate();

  return useMutation({
    mutationKey: ["users", "register"],
    mutationFn: async (data: Patient) => {
      return (await axiosInstance.post("/users/register", data)).data;
    },

    onError(error: AxiosError<PatientError>) {
      console.log(error);
      setErrors({
        email: {
          message: error.response?.data.errors.email![0],
        },
      });
    },

    onSuccess(data) {
      navigate("/login");
    },
  });
}

export function useLogin({
  setError,
}: {
  setError: UseFormSetError<{
    email: string;
    password: string;
  }>;
}) {
  const navigate = useNavigate();

  return useMutation({
    mutationKey: ["users", "login"],
    mutationFn: async (data: LoginData) => {
      return (await axiosInstance.post("/users/login", data)).data;
    },

    onError(error: AxiosError<LoginError>) {
      const data = error.response?.data;

      if (data?.errors.email) {
        setError("email", {
          message: data.errors.email[0],
        });
      }

      if (data?.errors.password) {
        setError("password", {
          message: data.errors.password[0],
        });
      }
    },

    onSuccess(data: SuccessLogin) {
      localStorage.setItem("auth_token", data.token);
      navigate(data.route);
    },
  });
}
