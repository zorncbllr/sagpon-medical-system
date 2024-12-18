import { useMutation, useQuery } from "@tanstack/react-query";
import { axiosInstance, getToken } from "./api";
import {
  Patient,
  PatientMutationResponse,
  Patients,
} from "../schemas/patient-interfaces";
import { queryClient } from "../main";
import { toast } from "sonner";
import { usePatientStore } from "../store/patients-store";
import { initialPatientFormData } from "../store/multiform-store";

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

interface PatientResponse {
  message: string;
  patient: Patient;
}

export function useFetchPatientById(patientId: string) {
  return useQuery({
    queryKey: ["patient"],
    queryFn: async (): Promise<Patient> => {
      return (
        await axiosInstance.post<PatientResponse>(
          `/patients/${patientId}`,
          {},
          {
            headers: {
              Authorization: `Bearer ${getToken()}`,
            },
          }
        )
      ).data.patient;
    },
    initialData: initialPatientFormData,
  });
}

export function useFetchPatientArchives() {
  return useQuery<Patient[]>({
    queryKey: ["patients", "archives"],
    queryFn: async (): Promise<Patient[]> => {
      return (
        (
          await axiosInstance.post<Patients>(
            "/patients/archives",
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
  const patient = useRegisterPatient();

  return useMutation({
    mutationKey: ["patients"],
    mutationFn: async (entityId: string) => {
      return (
        await axiosInstance.delete(`/patients/${entityId}`, {
          headers: {
            Authorization: `Bearer ${getToken()}`,
          },
        })
      ).data;
    },

    onSuccess: (data) => {
      client.invalidateQueries({
        queryKey: ["patients"],
      });

      console.log(data);

      toast("Patient was moved to archives.", {
        description: `${new Date().toLocaleTimeString()}`,
        action: {
          label: "Undo",
          onClick: () => {
            patient.mutate(data.patient);
          },
        },
      });
    },

    onError: (error) => {
      toast(error.message);
    },
  });
}

export function useRegisterPatient() {
  const client = queryClient;

  return useMutation({
    mutationKey: ["patients"],
    mutationFn: async (data: Patient) => {
      return (
        await axiosInstance.post(`/patients/register`, data, {
          headers: {
            Authorization: `Bearer ${getToken()}`,
          },
        })
      ).data;
    },

    onSuccess: (data) => {
      client.invalidateQueries({
        queryKey: ["patients"],
      });

      const date = new Date();

      toast("New patient has been created.", {
        description: `Created at ${date.toLocaleTimeString()}`,
        action: {
          label: "Undo",
          onClick: () => {
            // mutate(data.patient);
          },
        },
      });
      console.log(data);
    },

    onError: (error) => {
      toast(error.message);
    },
  });
}

export function useUpdatePatient() {
  const client = queryClient;
  const { setPatientsData } = usePatientStore();

  return useMutation({
    mutationKey: ["patients"],
    mutationFn: async (data: Patient) => {
      return (
        await axiosInstance.patch(`/patients/${data.patientId}`, data, {
          headers: {
            Authorization: `Bearer ${getToken()}`,
          },
        })
      ).data;
    },

    onSuccess: (data) => {
      client.invalidateQueries({
        queryKey: ["patients"],
      });

      setPatientsData(data.patient);

      const date = new Date();

      toast("Patient updated successfully.", {
        description: `Updated at ${date.toLocaleTimeString()}`,
        action: {
          label: "Undo",
          onClick: () => {
            // mutate(data.patient);
          },
        },
      });
      console.log(data);
    },

    onError: (error) => {
      toast(error.message);
    },
  });
}
