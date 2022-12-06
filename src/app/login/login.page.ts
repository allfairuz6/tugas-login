import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController, LoadingController, NavController, ToastController } from '@ionic/angular';
import { AccessProvider } from '../Providers/access-Providers';
import { Storage } from '@ionic/storage';
import axios from 'axios';
@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {


  email_address: string = "";
    password: string ="";

    disableButton;

  constructor(
    private router: Router,
    private toastCtrl: ToastController,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private accprov: AccessProvider,
    private storage: Storage,
    private navCtrl: NavController
  ) { }

  ngOnInit() {
  }

  async presentToast(a){
    const toast = await this.toastCtrl.create({
      message: a,
      duration: 1500
    });
    toast.present();
  }






  async trylogin(){

    if(this.email_address=""){
      this.presentToast('your email address is required');
    }else if(this.password==""){
      this.presentToast('your password is required');
    }
      this.disableButton = true;
      const loader = await this.loadingCtrl.create({
        message:'Please wait....',
      });
      loader.present();

      const fd = new FormData();
      fd.append('email_address', this.email_address);
      fd.append('password', this.password);

      try{
        const res = await axios.post('http://localhost/data_api/login.php', fd);
        console.log(res.data.result);
        if(res.data.error == false){
          loader.dismiss();
          this.disableButton = false
          this.presentToast('login sukses');
          this.storage.set('isLoggedIn', res.data.result);
          localStorage.setItem('isLoggedIn', res.data.result);
          this.navCtrl.navigateRoot(['/tabs/tab1']);
        }
        else{
          this.presentToast(res.data.result.message);
        }
      }
      catch(err){
        loader.dismiss();
        this.presentToast('Something went wrong');
      }

        // this.accprov.postData(body, 'proses_api.php').subscribe(async (res:any)=>{
        
        //  if(res.success==true){
        //     loader.dismiss();
        //     this.disabledButton = false;
        //     this.presentToast('login sukses');
        //     const storage = new Storage();
        //     await storage.create();
        //     storage.set('isLoggedIn', res.result);
        //     this.navCtrl.navigateRoot(['/tabs/tab1']);
        //  }else{
        //     loader.dismiss();
        //     this.disabledButton = false;
        //     this.presentToast('email or passsword wrong!')
        //   }
        //  });

  }

}