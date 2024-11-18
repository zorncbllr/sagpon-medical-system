import Logo from "../assets/logo";
import RegistrationForm from "../components/registration-form";
import BoxReveal from "../components/ui/box-reveal";

function Register() {
  return (
    <main className="w-full h-screen bg-white flex flex-col gap-4 items-center justify-center">
      <BoxReveal duration={0.4}>
        <Logo />
      </BoxReveal>
      <BoxReveal duration={0.6}>
        <h1 className="text-4xl font-semibold">Sagpon Health Station</h1>
      </BoxReveal>

      <BoxReveal duration={0.3}>
        <RegistrationForm />
      </BoxReveal>
    </main>
  );
}

export default Register;
