import { LoginForm } from "../components/login-form";
import Logo from "../assets/logo";
import GridPattern from "../components/ui/grid-pattern";
import BoxReveal from "../components/ui/box-reveal";

function Login() {
  return (
    <main className="w-full h-screen flex">
      <section className="w-full grid place-items-center">
        <div className="bg-backdrop w-4/5 h-4/5 bg-cover z-50 rounded-lg shadow-xl"></div>
        <GridPattern />
      </section>

      <section className="w-[55rem] h-full bg-white flex flex-col gap-6 items-center justify-center px-12 z-50 shadow-xl">
        <div className="grid place-items-center gap-4">
          <BoxReveal duration={0.2} boxColor="#16a34a">
            <Logo />
          </BoxReveal>
          <BoxReveal duration={0.2} boxColor="#16a34a">
            <h1 className="text-4xl font-semibold">Sagpon Health Station</h1>
          </BoxReveal>
          <BoxReveal duration={0.2} boxColor="#16a34a">
            <p className="text-center text-slate-500 before:content-[''] before:h-[0.1px] before:bg-slate-300 before:block before:m-4 after:content-[''] after:h-[0.1px] after:bg-slate-300 after:block after:m-4">
              Providing compassionate care and innovative solutions for a
              healthier community.
            </p>
          </BoxReveal>
        </div>
        <BoxReveal boxColor="#16a34a" duration={0.4}>
          <LoginForm />
        </BoxReveal>
      </section>
    </main>
  );
}

export default Login;
