import * as z from "zod";

export const firstStepSchema = z.object({
  firstName: z.string().nonempty(),
  middleName: z.string().nonempty(),
  lastName: z.string().nonempty(),
  address: z.string().nonempty(),
});

export const secondStepSchema = z.object({
  firstName: z.string().date().nonempty(),
  phoneNumber: z.number().nonnegative(),
  emergencyContact: z.number().nonnegative().optional(),
  insuranceProvider: z.string().optional(),
  policyNumber: z.number().nonnegative().optional(),
});

export const lastStepSchema = z
  .object({
    email: z.string().email(),
    password: z.string().min(8),
    confirmPassword: z.string().min(8),
  })
  .refine((data) => data.password === data.confirmPassword, {
    message: "Passwords don't match",
    path: ["confirmPassword"],
  });

export type BasicPatientInfo = z.infer<typeof firstStepSchema>;
export type AdditionalPatientInfo = z.infer<typeof secondStepSchema>;
export type LastPatientInfo = z.infer<typeof lastStepSchema>;

export interface PatientFormData {
  firstName: string;
  middleName: string;
  lastName: string;
  gender: "male" | "female" | "other";
  email: string;
  birthDate: string;
  address: string;
  phoneNumber: number;
  emergencyContact: number;
  insuranceProvider: string;
  policyNumber: number;
  password: string;
  confirmPassword: string;
}
