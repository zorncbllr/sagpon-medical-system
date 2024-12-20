import { useMutation, useQuery } from "@tanstack/react-query";
import { axiosInstance, getToken } from "./api";
import { Patient, PatientError, Patients } from "../schemas/patient-interfaces";
import { queryClient } from "../main";
import { toast } from "sonner";
import { usePatientStore } from "../store/patients-store";
import { initialPatientFormData } from "../store/multiform-store";
import { AxiosError } from "axios";
import { useUndoArchive } from "./archive-services";

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

export function useDeletePatient() {
  const client = queryClient;
  const patient = useUndoArchive();

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

    onError: (error: AxiosError<PatientError>) => {
      toast(error.response?.data.message);
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

    onError: (error: AxiosError<PatientError>) => {
      toast(error.response?.data.message);
    },
  });
}

export function useUpdatePatient() {
  const client = queryClient;
  const { setPatientsData } = usePatientStore();

  return useMutation({
    mutationKey: ["patient"],
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
        queryKey: ["patient"],
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

    onError: (error: AxiosError<PatientError>) => {
      toast(error.response?.data.message);
    },
  });
}

export function useDownloadPatients() {
  return useMutation({
    mutationKey: ["downloads"],
    mutationFn: async () => {
      return (
        await axiosInstance.post(
          "/patients/download",
          {},
          {
            headers: {
              "Content-Type":
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            },
          }
        )
      ).data;
    },

    onSuccess: (data) => {
      const base64String = data.file;
      const binaryString = atob(base64String);
      const binaryLen = binaryString.length;
      const bytes = new Uint8Array(binaryLen);

      for (let i = 0; i < binaryLen; i++) {
        bytes[i] = binaryString.charCodeAt(i);
      }

      const blob = new Blob([bytes], {
        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
      });

      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.setAttribute("download", "patients.xlsx");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

      toast("Download successful.", {
        description: data.message,
        action: {
          label: "Okay",
          onClick: () => {},
        },
      });
    },

    onError: (error) => {
      console.log(error);
    },
  });
}
