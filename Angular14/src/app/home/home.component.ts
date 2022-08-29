import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.sass'],
})
export class HomeComponent implements OnInit {
  public name = 'Son';
  public age = 18;
  public fruits = [
    { name: 'tao', price: 20000, origin: 'chinene', saleOff: 40 },
    { name: 'dua', price: 40000, origin: 'vietnamese', saleOff: 70 },
    { name: 'mit', price: 23000, origin: 'US', saleOff: 50 },
    { name: 'oi', price: 10000, origin: 'korean', saleOff: 60 },
  ];

  public provinces = [
    { name: 'Hà Nội', district: ['Gia Lâm', 'Long Biên', 'Hai Bà Trưng', 'Thanh Xuân', 'Cầu Giấy'] },
    { name: 'Bắc Ninh', district: ['Từ sơn', 'Yên Phong', 'Quế Võ'] },
    { name: 'Hồ Chí Minh', district: ['Quận nhất', 'Quận 9', 'Quận bình thạch'] },
  ];

  districts :String[] = []
  constructor() { }

  ngOnInit(): void {
    this.districts = this.provinces[0]['district']
   }

  upAge() {
    this.age++;
  }

  changeCity(event: any) {
    this.provinces.forEach(province => {
      if(province.name == event.target.value){
        this.districts = province.district
      }
    });
    
  }
}
