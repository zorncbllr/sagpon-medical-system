import { useMutation, useQuery } from "@tanstack/react-query";
import { axiosInstance, getToken } from "./api";
import { Patient, Patients } from "../schemas/patient-interfaces";
import { queryClient } from "../main";

export function useFetchPatients() {
  return useQuery<Patient[]>({
    queryKey: ["patients"],
    queryFn: async (): Promise<Patient[]> => {
      return (
        (
          await axiosInstance.post<Patients>(
            "/patients",
            {},
            {
              headers: {
                Authorization: `Bearer ${getToken()}`,
              },
            }
          )
        ).data.patients ?? []
      );
    },
    initialData: [],
  });
}

export function useDeletePatient() {
  const client = queryClient;

  return useMutation({
    mutationKey: ["patients"],
    mutationFn: async (entityId: string) => {
      return await axiosInstance.delete(`/patients/${entityId}`, {
        headers: {
          Authorization: `Bearer ${getToken()}`,
        },
      });
    },

    onSuccess: () => {
      client.invalidateQueries({
        queryKey: ["patients"],
      });
    },

    onError: (error) => {
      console.log(error);
    },
  });
}
