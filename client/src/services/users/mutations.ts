import { useMutation } from "@tanstack/react-query";
import { PatientFormData } from "../../schemas/patient-interfaces";
import { axiosInstance } from "../api";
import { AxiosError } from "axios";

export function useRegister() {
  return useMutation({
    mutationKey: ["users", "register"],
    mutationFn: async (data: PatientFormData) => {
      return (await axiosInstance.post("/users/register", data)).data;
    },

    onError(error: AxiosError) {
      console.log(error.response?.data);
    },

    onSuccess(data) {
      console.log(data);
    },
  });
}
