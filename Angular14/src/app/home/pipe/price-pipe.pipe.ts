import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'pricePipe'
})
export class PricePipePipe implements PipeTransform {

  transform(value: unknown, ...args: unknown[]): unknown {
    console.log('value: ', value);
    console.log('args: ', args);
    
    return null;
  }

}
